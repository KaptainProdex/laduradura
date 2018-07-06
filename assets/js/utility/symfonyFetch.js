export function symfonyFetch(path, method, data) {
    return new Promise (function (resolve, reject) {
        let options = {
            method: method,
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
            }
        }

        if (data) {
            options['body'] = JSON.stringify(data)
        }

        fetch(path, options).then(function (response) {
            return response.json()
        }).then(function (json) {
            resolve(json)
        })

    })
}