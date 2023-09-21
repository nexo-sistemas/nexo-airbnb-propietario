import indexDB from "../functions/indexDB";


export default (async () => {
    let navegador = navigator.userAgent;
    //window.location.href = `/${document.getElementById('codbase64').value}`

    // android
    if (navigator.userAgent.match(/Android/i)) {
        /*
        const urlParams  = new URLSearchParams(window.location.search);
        const uuid = urlParams.get("u");
        indexDB(uuid).then(() => {
            const uuidValueIndexDB = document.getElementById('indexDB__');
            window.location.href = `/?u=${uuidValueIndexDB}`
        });

        */
       return;
    }

    // ios
    if (navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i)) {
        window.location.href = `/ios/${document.getElementById('codbase64').value}`
        return;
    }

    window.location.href = `/${document.getElementById('codbase64').value}`
})();
