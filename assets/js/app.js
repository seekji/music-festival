import '../vendor-styles/vendor.css';
import '../styles/app.less';
import $ from 'jquery';

const files = require.context('../svg-sprite', false, /\.svg$/);
files.keys().forEach(files);