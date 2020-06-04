/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: process.env.MIX_APP_ENV === 'local' ? 6001 : 6002,
    wssPort: process.env.MIX_APP_ENV === 'local' ? 6001 : 6002,
    disableStats: true,
    encrypted: true,
    enabledTransports: ['ws', 'wss'],
});