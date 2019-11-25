server '5.101.51.242', user: 'www-data', roles: %w{app db web}, port: 22

set :deploy_to, '/var/www/music-festival'
set :branch, 'master'
set :symfony_env,  "prod"

after 'deploy:finishing', 'deploy:fpm_nginx_restart'

namespace :deploy do
    task :fpm_nginx_restart do
        on roles(:app) do
          execute "sudo /etc/init.d/php7.3-fpm restart"
          execute "sudo /etc/init.d/nginx restart"
        end
    end
end