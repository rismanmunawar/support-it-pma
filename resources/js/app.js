import './bootstrap';
import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import { faqPage } from './faq';
import './excel-monitoring';
import './bootstrap';
import '../css/app.css'; // pastikan baris ini ada

window.faqPage = faqPage;


Alpine.plugin(collapse)
window.Alpine = Alpine;
Alpine.start();
