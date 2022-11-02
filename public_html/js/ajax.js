function requestSuccess(data) {
    if(data.status == 'ok') {
        $('#result-table').empty();
        $.each(data.data, function(key, val){
            let tr = $('<tr></tr>');
            if(val.state == 'Новый') tr.addClass('text-bg-success');
            else if(val.state == 'Закрытый') tr.addClass('text-bg-danger');
            else tr.addClass('text-bg-info');
            let tdId = $('<td></td>').append(val.id);
            let tdState = $('<td></td>').append(val.state);
            let tdNumber = $('<td></td>').append(val.number);
            let tdCreate = $('<td></td>').append(val.createDate);
            let tdExpire = $('<td></td>').append(val.expireDate);
            let tdProduct = $('<td></td>').append(val.productName);
            let tdDeclarant = $('<td></td>').append(val.declarant);
            let tdMfr = $('<td></td>').append(val.mfr);
            let tdSource = $('<td></td>').append(val.productSource);
            let tdType = $('<td></td>').append(val.type);
            tr.append(tdId)
                .append(tdState)
                .append(tdNumber)
                .append(tdCreate)
                .append(tdExpire)
                .append(tdProduct)
                .append(tdDeclarant)
                .append(tdMfr)
                .append(tdSource)
                .append(tdType);
            $('#result-table').append(tr);
        });
    } else {
        console.log(data);
        $('#result-table').empty().append('<tr><td style="text-align: center" colspan="10">Невозможно получить данные</td></tr>');
    }
}
function requestError(response)
{
    console.log(response);
    $('#result-table').empty().append('<tr><td style="text-align: center" colspan="10">Невозможно получить данные ('+response.responseText+')</td></tr>');
}
$('document').ready(function(){
    $('#form-filter').submit(function(){
        $.ajax({
            method: 'POST',
            data: $('#form-filter').serializeArray(),
            dataType: 'json',
            success: requestSuccess,
            error: requestError
        });
        return false;
    });
});
