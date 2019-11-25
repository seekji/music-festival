# config valid only for current version of Capistrano
lock '3.11.0'

set :application, 'music-festival'
set :scm, :git
set :repo_url, ''
set :symfony_directory_structure, 4
set :composer_install_flags, '--no-interaction --optimize-autoloader --prefer-dist --no-dev'
set :format_options, log_file: "var/log/capistrano.log"
set :web_path, "public_html"
set :assets_install_path, fetch(:web_path)

set :keep_releases, 3

# The next 3 settings are lazily evaluated from the above values, so take care
# when modifying them
set :app_config_path, "config"

# Dirs that need to remain the same between deploys (shared dirs)
set :linked_dirs, fetch(:linked_dirs, []).push('public_html/uploads', 'var/log')

# Files that need to remain the same between deploys
set :linked_files, fetch(:linked_files, []).push('.env.local')

set :symfony_console_path, "bin/console"

set :file_permissions_paths, ["var/log", "var/cache"]
set :file_permissions_users, ["www-data"]
set :permission_method, 'chmod'

# Insure rsync is available (it's needed for frontend build upload)
before 'deploy:starting', 'check:all'

# Apply migrations
after 'deploy:updated', 'deploy:migrate'

namespace :check do
    task :all do
        invoke 'check:rsync'
        invoke 'check:frontend_build'
    end
    task :rsync do
        run_locally do
            unless system "which rsync > /dev/null 2>&1"
                abort "Cannot find rsync executable, please install it first"
                exit 1
            end
        end
    end
end

namespace :deploy do
    task :migrate do
        on roles(:db) do
            symfony_console "doctrine:database:create", "--if-not-exists"
            symfony_console "doctrine:migrations:migrate", "--no-interaction"
        end
    end

    task :fix_media do
        on roles(:db) do
            symfony_console "sonata:media:fix-media-context", "--quiet"
        end
    end

    task :upload_frontend do
        on roles(:web) do |host|
            run_locally do
                execute "rsync -e 'ssh -p #{host.port}' --recursive --times --human-readable --progress web/bundles/frontend/ #{host.user}@#{host.hostname}:#{release_path}/web/bundles/frontend"
            end
        end
    end
end