import './bootstrap';

import Alpine from 'alpinejs';
import sliderData from './components/sliderData'

window.Alpine = Alpine;
Alpine.data('sliderData', sliderData)

Alpine.start();
