// main.jsx
import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import './styles/index.css';
import '@fontsource/instrument-serif';

import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
  duration: 400,
  once: true,
  disable: 'mobile', 
});

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);