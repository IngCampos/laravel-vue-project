const dateFilter = function (value) {
    if (!value)
        return '';
    // input(from database) : 2020-04-24T00:12:07.000000Z
    var h = value.split('T')[1].split('.')[0].split(':');
    var d = value.split('T')[0].split('-');
    var y = d[0].split('');
    // output(to the views) : 00:12 24/4/20
    return h[0] + ":" + h[1] + " " + d[2] + "/" + d[1] + "/" + y[2] + y[3];
}

export {
    dateFilter
}
