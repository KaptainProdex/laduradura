export function responseTransformer (object, data) {
    data.forEach(function (element) {
        object[element.id] = element
    })
}