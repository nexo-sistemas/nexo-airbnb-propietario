export default async (uuid) => {
    var indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB,
        IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction;

    const request = window.indexedDB.open("ritpropietario", 1);

    request.onerror = (error) => {
        console('"Why didnt you allow my web app to use IndexedDB?', error);
    };

    var  db;

    request.onupgradeneeded = (event) => {
        const db = event.target.result;
        const objectStore = db.createObjectStore("propietario", { keyPath: "id" });
        objectStore.createIndex("uuid", "id", { unique: false });
    };

    const successLO = request.onsuccess = (event) => {
        db = event.target.result;
        const bikeObjectStore = db.transaction("propietario", "readwrite").objectStore("propietario");
        bikeObjectStore.add({ id: '1', uuid: uuid });
        const transaction = db.transaction(["propietario"]);
        const store = transaction.objectStore("propietario");
        var puntero = store.openCursor();
        puntero.addEventListener("success", obtenerdata);
    };

    const obtenerdata = async(evento) => {
        var puntero  = evento.target.result
        document.getElementById('indexDB__').value = puntero.value.uuid;
    }

}
