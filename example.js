
function test(uri, data) {
    fetch(uri, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then((response) => {
        console.log(response);
        return response.json();
    })
    .then((r) => {
        // réponse
        console.log(r);
    });
}
