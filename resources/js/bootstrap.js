import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

Pusher.logToConsole=true;

// const echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: false,
// });


// export default echo;

// Настройка Pusher
const pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false,
});

export default pusher;


