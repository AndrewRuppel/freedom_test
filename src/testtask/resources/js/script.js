document.addEventListener('DOMContentLoaded', loadDocument);

function loadDocument() {

    document.getElementById('form').addEventListener('submit', function (e) {
        e.preventDefault();

        const url = '/form';

        postForm(url, e.target);
    });
}

function postForm(url, form) {
    const data = new URLSearchParams();

    for (const pair of new FormData(form)) {
        data.append(pair[0], pair[1]);
    }

    fetch(url, {
        method: 'post',
        body: data,
    })
    .then((response) => response.json())
    .then((data) => {
        document.getElementById('count').innerText = data.count;
        console.log('Success:', data);
    })
}