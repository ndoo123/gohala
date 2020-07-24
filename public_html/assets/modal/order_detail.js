
// order detail
$(document).on('click','.order_detail',function(){
    var modal = $("#modal_order_detail");
    // Load('modal_order_detail',true);
    Load(modal,true);
    var order_id = $(this).attr('order_id');
    // console.log(location);
    // console.log(order_id);
    var url = location.origin+'/order_detail';
    console.log(url);
    var obj = new Object();
    obj._token = $('meta[name=csrf-token]').attr('content');
    obj.order_id = order_id;
    console.log(obj);
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        data: obj,
        success: function(res){
            console.log(res);
            // Load('modal_order_detail',false);
            Load(modal,false);

            // detail item
            var item = res.items;
            var append = '';
            for(index in item)
            {
                // console.log(item);
                // console.log(index);
                // console.log(item[index]);
                var i = parseInt(index)+1;
                var price = parseFloat(item[index].price);
                var qty = item[index].qty;
                var total = price * qty;
                append += '<tr>';
                    append += '<td>';
                    append += i;
                    append += '</td>';
                    append += '<td>';
                    append += item[index].product_name+' x'+item[index].qty;
                    append += '</td>';
                    append += '<td>';
                    append += price.toFixed(2);
                    append += '</td>';
                    append += '<td>';
                    append +=  total.toFixed(2);
                    append += '</td>';
                append += '</tr>';
            }
            var table = modal.find('table');
            var tbody = table.find('tbody');
            tbody.find('tr').remove();
            tbody.append(append);
            // end detail item

            // detail order all

            var order = res.order;
            // console.log(Object.keys(order));
            var body = modal.find('.col-4');
            var append2 = '';
            append2 += '<h5> Order # ' + order.id + '</h5>';
            append2 += '<hr>';
            append2 += '<div id="accordion">';
                append2 += '<div class="card mb-1">';
                    append2 += '<div class="card-header p-3" id="headingOne">';
                        append2 += '<h6 class="m-0 font-14">';
                            append2 += '<a href="#collapseOne" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">';
                                append2 += 'ร้านค้า';
                            append2 += '</a>';
                        append2 += '</h6>';
                    append2 += '</div>';
                    append2 += '<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">';
                        append2 += '<div class="card-body">';
                        var rest = res.rest;
                        Object.keys(rest).forEach(function(e){
                            if(rest[e] !== null)
                            {
                            append2 += '<h5 class="font-16 font-weight-bold">';
                                append2 += e;
                            append2 += '</h5>';
                            append2 += '<span class="text-muted">';
                                append2 += rest[e];
                            append2 += '</span>';
                            }
                        });
                        append2 += '</div>';   
                    append2 += '</div>';
                append2 += '</div>';
                append2 += '<div class="card mb-1">';
                    append2 += '<div class="card-header p-3" id="headingCus">';
                        append2 += '<h6 class="m-0 font-14">';
                            append2 += '<a href="#collapseCus" class="text-dark collapsed" data-toggle="collapse" aria-expanded="true" aria-controls="collapseCus">';
                                append2 += 'ข้อมูลผู้ซื้อ';
                            append2 += '</a>';
                        append2 += '</h6>';
                    append2 += '</div>';
                    append2 += '<div id="collapseCus" class="collapse" aria-labelledby="headingCus" data-parent="#accordion" style="">';
                        append2 += '<div class="card-body">';
                        var cus = res.cus;
                        Object.keys(cus).forEach(function(e){
                            if(cus[e] !== null)
                            {
                            append2 += '<h5 class="font-16 font-weight-bold">';
                                append2 += e;
                            append2 += '</h5>';
                            append2 += '<span class="text-muted">';
                                append2 += cus[e];
                            append2 += '</span>';
                            }
                        });
                        append2 += '</div>';   
                    append2 += '</div>';
                append2 += '</div>';
            append2 += '</div>';
            append2 += '<hr>';

            var detail = res.detail;
            console.log(Object.keys(detail));
            Object.keys(detail).forEach(function(e){
                // console.log(detail);
                // console.log(e);
                // console.log(detail[e]);

                append2 += '<span class="font-weight-bold font-14 mb-0">' + e + ' </span>';
                append2 += '<span class="font-16">' + detail[e] + '</span>';
                append2 += '<hr>';
            });
            body.html('');
            body.append(append2);
            // end detail order all
            $("#modal_order_detail").modal('show');
        }
    });
});
// end order detail