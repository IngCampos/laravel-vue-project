/*!Sort array elements by a numeric property. */
Array.prototype.orderByNumber = function (property, sortOrder) {
    // First, it is verified that the sortOrder property has valid data.
    if (sortOrder != -1 && sortOrder != 1) sortOrder = 1;
    this.sort(function (a, b) {
        // The ordering function returns the comparison between property of a and b.
        // The result will be affected by sortOrder.
        return (a[property] - b[property]) * sortOrder;
    })
}
/*! Sort array elements by a property of type Stringg */
Array.prototype.orderByString = function (property, sortOrder, ignoreCase) {
    if (sortOrder != -1 && sortOrder != 1) sortOrder = 1;
    this.sort(function (a, b) {
        var stringA = a[property],
            stringB = b[property];
        // If a value is null or undefined, it is converted to an empty string.
        if (stringA == null) stringA = '';
        if (stringB == null) stringB = '';
        // If ignoreCase is true, both variables are converted to lowercase.
        if (ignoreCase == true) {
            stringA = stringA.toLowerCase();
            stringB = stringB.toLowerCase()
        }
        var res = 0;
        if (stringA < stringB) res = -1;
        else if (stringA > stringB) res = 1;
        return res * sortOrder;
    })
}
/*! Sort arrangement items  */
Array.prototype.orderByDate = function (property, sortOrder) {
    if (sortOrder != -1 && sortOrder != 1) sortOrder = 1;
    this.sort(function (a, b) {
        var dateA = new Date(a[property]),
            dateB = new Date(b[property]);
        return (dateA - dateB) * sortOrder;
    })
}
