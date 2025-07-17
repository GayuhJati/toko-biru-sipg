import './bootstrap';
import Chart from 'chart.js/auto';
import { initCKEditor } from './ckeditor';

document.addEventListener('DOMContentLoaded', () => {
    const editor = document.querySelector('#editor');
    if (editor) {
        initCKEditor('#editor', '/upload-image?_token=' + document.querySelector('meta[name="csrf-token"]').content);
    }
});

