// resources/js/app.jsx
import React from 'react';
import { createRoot } from 'react-dom/client';
// import ReactDOM from 'react-dom/client';

import APP from './components/App';

// Get the root DOM element
const rootElement = document.getElementById('root');

if (rootElement) {
    const root = createRoot(rootElement);
    root.render(<App />);
}
