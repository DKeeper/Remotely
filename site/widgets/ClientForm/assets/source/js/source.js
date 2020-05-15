/**
 * Simple object check.
 * @param item
 * @returns {boolean}
 */
function isObject(item) {
    return (item && typeof item === 'object' && !Array.isArray(item));
}

/**
 * Deep merge two objects.
 * @param target
 * @param sources
 */
function mergeDeep(target, sources) {
    if (isObject(target) && isObject(sources)) {
        for (var key in sources) {
            if (isObject(sources[key])) {
                if (!target[key]) {
                    target[key] = {};
                }

                mergeDeep(target[key], sources[key]);
            } else {
                target[key] = sources[key];
            }
        }
    }
}

jQuery(function() {
    /**
     * Convert serialized array to Object
     * @param v
     * @return Object
     */
    var convertFormData = function (v) {
        var data = {};
        v.forEach(function (value) {
            var names = value.name.split('.').reverse();
            var v = value.value;
            var t = {};
            names.forEach(function (name) {
                t[name] = v;
                v = t;
                t = {};
            });
            mergeDeep(data, v);
        });

        return data;
    };

    var onSubmit = function () {
        var parameters = convertFormData($(this).serializeArray());
        console.log(parameters);
        var method = parameters.methods;
        delete parameters.methods;

        if (method !== 'update') {
            delete parameters.id;
        }

        var url = $(this).data('url');
        var client = new $.JsonRpcClient({ajaxUrl: url});
        client.call(
            method,
            [parameters],
            function (result) {
                $('.response-result').removeClass('panel-danger');
                $('.response-result .panel-body').empty().append($('<pre>').append(JSON.stringify(result, null, 4)));
                console.log(result);
            },
            function (error) {
                $('.response-result').addClass('panel-danger');
                $('.response-result .panel-body').text(JSON.stringify(error, null, 4));
                console.log(error);
            }
        ).done(function () {
            $('.request-data .panel-body').text(this.data);
        });
        return false;
    };

    var onMethodChange = function () {
        $('#' + window.clientOption.formId + ' .field-id').toggleClass('hidden', $(this).val() !== 'update');
    };

    $('#' + window.clientOption.formId).submit(onSubmit);
    $('#' + window.clientOption.formId + ' select').on('change', onMethodChange);
});
