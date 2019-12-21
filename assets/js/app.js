import '../styles/app.less';
import '../vendor-styles/vendor.css';
import $ from 'jquery';

const files = require.context('../svg-sprite', false, /\.svg$/);
files.keys().forEach(files);