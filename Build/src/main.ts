import './style.css';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

declare global {
  interface Window {
    Alpine: typeof Alpine;
  }
}

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
