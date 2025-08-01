window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

// realtime antrian layanan informasi
window.Echo.channel("informasi-antrian").listen("AntrianInformasi",(event) =>{
    console.log(event.informasi.nomor_urut);

    document.getElementById('antrian_informasi').innerHTML = event.informasi.nomor_urut;
});

// tutup layanan antrian informasi
window.Echo.channel("tutup-antrian-informasi").listen("TutupAntrianInformasi",(event) =>{
    console.log(event.tutupAntrianInformasi.tutup);

    document.getElementById('antrian_informasi').innerHTML = event.tutupAntrianInformasi.tutup;
});



// realtime antrian layanan kunjungan
window.Echo.channel("informasi_kunjungan1").listen("AntrianKunjungan1",(event) =>{
    console.log(event.kunjungan1.nomor_urut);

    document.getElementById('antrian_kunjungan1').innerHTML = event.kunjungan1.nomor_urut;
});

window.Echo.channel("informasi_kunjungan2").listen("AntrianKunjungan2",(event) =>{
    console.log(event.kunjungan2.nomor_urut);

    document.getElementById('antrian_kunjungan2').innerHTML = event.kunjungan2.nomor_urut;
});

window.Echo.channel("informasi_kunjungan3").listen("AntrianKunjungan3",(event) =>{
    console.log(event.kunjungan3.nomor_urut);

    document.getElementById('antrian_kunjungan3').innerHTML = event.kunjungan3.nomor_urut;
});



// realtime antrian layanan pengaduan
window.Echo.channel("pengaduan-antrian").listen("AntrianPengaduan",(event) =>{
    console.log(event.pengaduan.nomor_urut);

    document.getElementById('antrian_pengaduan').innerHTML = event.pengaduan.nomor_urut;
}); 