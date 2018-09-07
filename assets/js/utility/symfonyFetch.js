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
            let contentType = response.headers.get("content-type")

            if (contentType && contentType.indexOf("application/json") !== -1) {
                return response.json()
            }
        }).then(function (json) {
            resolve(json)
        })

    })
}