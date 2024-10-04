import { createRoot } from 'react-dom/client';
import './bootstrap';
import App from './components/App';
import Chat from './components/Chat';
import Home from './components/Home';

const appContainer = document.getElementById('app');
const appRoot = createRoot(appContainer);
appRoot.render(<App />);

const chatContainer = document.getElementById('chat');

if (chatContainer) {

    const chatRoot = createRoot(chatContainer);

    chatRoot.render(<Chat />);
}

const homeContainer = document.getElementById('home');

if (homeContainer) {

    const homeRoot = createRoot(homeContainer);

    homeRoot.render(<Home />);
}