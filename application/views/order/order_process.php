<script type="text/javascript">
  var tb_order;
  var tb_orderline;
  var id_order;

  $(function () {
    var pageUrl = window.location.href;
    var lastUrlSegment = pageUrl.substr(pageUrl.lastIndexOf('/') + 1);

    tb_order = $('#table-order').DataTable({
      'ajax': '<?php echo site_url('order/getAll') ?>',
      'processing': true,
      'language': {
        'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
      },
      'orders': [],
      'columnDefs': [
        { 
          'targets': -1, //last column
          'orderable': false, //set not orderable
        }, 
      ]
    });

    tb_orderstatus = $('#table-orderstatus').DataTable({
      'ajax': function(data, callback, settings) {
        $.ajax({
          url: '<?php echo site_url('order/getListStatus') ?>',
          type: 'POST',
          async: false,
          data: {status:lastUrlSegment},
          dataType: 'JSON',
          success: function(data) {
            // console.log(data);
            callback(data);
          }
        });
      },
      'processing': true,
      'language': {
        'processing': '<i class="fa fa-spinner fa-spin fa-10x fa-fw"></i><span> Processing...</span>'
      },
      'orders': [],
      'columnDefs': [
        { 
          'targets': -1, //last column
          'orderable': false, //set not orderable
        }, 
      ]
    });

    doChecked();    
    doSave();
    reloadOrder();
  });

  function getOrderStatus(status) {
    window.location.href= '<?php echo site_url('order/status/') ?>'+status;
  }

  function reloadOrder() {
    tb_order.ajax.reload(null, false);
    tb_orderstatus.ajax.reload(null, false);
  }

  function reloadOrderline() {
    tb_orderline.ajax.reload(null, false);
  }

  //proses generate shipment
  function doGenerate(getOrderId) {
    var statusOrder = getStatus(getOrderId).status;
    var isShipment = getStatus(getOrderId).shipment;
    var invoiceRule = getStatus(getOrderId).invoicerule;
    var url = '<?php echo site_url('order/actGenerateShip') ?>'; 

    if (statusOrder == 'IP' && invoiceRule == 'I') {
      Swal.fire({
        title: 'Do you want to start the Generate?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fa fa-check"></i> OK',
        cancelButtonText: '<i class="fa fa-close"></i> Cancel',
        showLoaderOnConfirm: true,
        preConfirm: (generate) => {
          return new Promise((resolve) => {
            setTimeout(() => {
              resolve()
            }, 2000)
          })
        },
        // allowOutsideClick: () => !Swal.isLoading()
        allowOutsideClick: false
      }).then((result) => {
        if(result.value) {          
          $.ajax({
            url: url,
            type: 'POST',
            data: {id_order: getOrderId},
            success: function(data) {
              Swal.fire({
                title: 'Updated!',
                text: 'Document No has been updated.',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
              })
              doSendEmail(getOrderId);
            }
          })
        }
      })
    } else if (statusOrder !== 'CO') {
      var alert = '<h4><i class="icon fa fa-ban"></i"></i> Info!</h4> Please, complete the qty check!';

      $.bootstrapGrowl(alert, {
        type: 'danger',
        offset: {from: 'top', amount: 50},
        width: 'auto'
      });
    }
  }

  //get data orderline
  function doOrderLine(getOrderId) {
    var url = '<?php echo site_url('order/getLinedetail') ?>';
    var documentno;

    tb_orderline = $('#table-orderline').DataTable({
      'ajax': function (data, callback, settings) {
        $.ajax({
          url: url,
          type: 'POST',
          async : false,
          data: {id_order:getOrderId},
          dataType: 'JSON',
          success: function(data){
            callback(data);
            numberMin();

            $.each(data, function (index, value) {
              documentno = value[0][10];
              id_order = value[0][11];
            });
          }
        });
      },
      'processing': true,
      'lengthChange': false, //filter row
      'searching'   : false, //filter search
      'orders': [],
      'columnDefs': [
      { 
            'targets': -1, //last column
            'orderable': false, //set not sort by
          }
        ],
      'destroy': true //destroy data
    });

    if (getStatus(id_order).status == 'CO') {
      $('#btnSaveOrderline').attr('disabled',true);
    } else {
      $('#btnSaveOrderline').attr('disabled',false);
    }
    $('#modal_order').modal({backdrop: 'static', keyboard: false});
    $('.modal-title').text(documentno); //Text Header Title

  }
  
  //checkbox click change input
  function doChecked() {
    $('#table-orderline').on('click','.data-check',function(){
      var row = $(this).closest('tr');      
      // var qtyZero = 0;
      // var isQtyAvailable = '<input type="number" value="'+qtyAvailable+'">';
      var qtyCheck = row.find('td:eq(7)').text();
      var qtyAvailable = row.find('td:eq(8)').text();
      var isQtyAvailable = '<input type="number" value="'+qtyAvailable+'">';
      var getQtyAvailable = row.find("td:eq(8) input[type='number']").val();

      // if (qtyCheck > 0) {
        // isQtyAvailable = '<input type="number" value="'+qtyZero+'">';
      // } else {
      //   isQtyAvailable = '<input type="number" value="'+qtyAvailable+'">';
      // }

      if($(this).is('.data-check:checked') ) {
        row.find('td:eq(8)').html(isQtyAvailable);
        numberOnly();
        numberMin();
      } else {
        row.find('td:eq(8)').html(getQtyAvailable);
      }

    });
  }

  //action save button modal
  function doSave() {
    $('#btnSaveOrderline').click(function() {
      var allPage = tb_orderline.rows().nodes(); //all page get data
      var isCheckbox = $('.data-check:checked', allPage);      

      //checked more then 0
      if(isCheckbox.length > 0 ) {
        var values = [];
        var getQtyArr = [];
        var getCheckedId = [];
        var isChecked = 'Y';        
        var getArrId = getSameQtyId(); //ID Line yg memiliki qtychecking sama dengan qtyorder
        
        $.each(isCheckbox, function () {        
          var rows = $(this).closest('tr');
          var getQty = rows.find('td:eq(8) input[type="number"]').val();
          var getNumber = rows.find('td:eq(0)').text();
          var getOrderlineId = rows.find(isCheckbox).val();
          var qtyReserved = isQtyReserved(getOrderlineId);

          getCheckedId.push(getOrderlineId);
          values.push({id_orderline:getOrderlineId, qty:getQty});
          getQtyArr.push({id:qtyReserved[0], qtyres:qtyReserved[1], qtycheck:qtyReserved[2], qtyorder:qtyReserved[3], isnum:getNumber});

        });

        var valuesDiff = differenceOfArrays(getCheckedId,getArrId);
        var convertArrId = getArrId.toString().split(',').map(Number);
        var containsValue = containsAny(valuesDiff,convertArrId);
        var valueGreater = greaterThanQty(values,getQtyArr);
        var valueQtyZero = getQtyZero(values);        
        var totalQtyOrder = getTotalQty();
        var sameTotalQty = getSameTotalQty(values, getQtyArr, totalQtyOrder);

        // getArrId value is null in db or valuesDiff is null when checked same value db
        if(getArrId.length == 0 || valuesDiff.length == 0 || (valuesDiff.length > 0 && containsValue == false))
        {
          //check value greater than qtyreserved or qtyoredered
          if(valueGreater.length > 0) {
            for (var k in valueGreater) {
              var countQtyExceed = valueGreater.length;
              var numQtyExceed = valueGreater[k].isnum;
              var qtyResExceed = valueGreater[k].qtyres;

              var error_message = '<h4><i class="icon fa fa-ban"></i> Error!</h4> (#'+countQtyExceed+') - Line: '+numQtyExceed+'. Total Qty Reserved Exceed SO Qty - Allowed Qty = '+qtyResExceed+'';

              $.bootstrapGrowl(error_message, {
                type: 'danger',
                width: 450,
                offset: {from: 'top', amount: 50},
                align: 'center',
                delay: false
              });
            }

          } else if (getStatus(id_order).status == 'CO') {
            var success_message = '<h4><i class="icon fa fa-info"></i> Information!</h4> Your data has been completed!';

            $.bootstrapGrowl(success_message, {
              type: 'success',
              width: 'auto',
              offset: {from: 'top', amount: 50}
            });
            reloadOrder();
            $('#modal_order').modal('hide');

          } else if (valuesDiff.length == 0) { //Selected another data
            var error_message1 = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Please select another data!';

            $.bootstrapGrowl(error_message1, {
              type: 'danger',
              width: 450,
              offset: {from: 'top', amount: 50},
              align: 'center',
              delay: 2000
            });

          } else if(valueQtyZero.length > 0) { //input data qty zero
            var error_message2 = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Transaction Quantity Available cannot zero!';

            $.bootstrapGrowl(error_message2, {
              type: 'danger',
              width: 450,
              offset: {from: 'top', amount: 50},
              align: 'center',
              delay: 2000
            });

         } else {
          if(sameTotalQty == true) {
            doCompleted(values, isChecked); 
          } else {
            doProgress(values, isChecked);
          }
        }

      } else if (valuesDiff.length > 0){
        var error_message3 = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Current record was changed by another user, please Refresh!';

        $.bootstrapGrowl(error_message3, {
          type: 'danger',
          width: 450,
          offset: {from: 'top', amount: 50},
          align: 'center',
          delay: 5000
        });
      }

    } else {
      var error_message4 = '<h4><i class="icon fa fa-ban"></i> Error!</h4> Please selected data!';

      $.bootstrapGrowl(error_message4, {
        type: 'danger',
        width: 450,
        offset: {from: 'top', amount: 50},
        align: 'center',
        delay: 2000
      });
    }
  });
}

  // function saveCompleted(getLineId, getQty, getChecked) {
  function doCompleted(arrValue, isChecked) {
    var url = '<?php echo site_url('order/actUpdate') ?>';
    var docStatus = 'CO';    
    var inputOptionsPromise = new Promise(function (resolve) {
      resolve({
        'RE': 'Revert',
        'PR': 'Process'
      })
    })

    Swal.fire({
      // title: 'Document Action',
      title: 'Do you want to start Complete and Generate Shipment?',
      // input: 'select',
      // inputOptions: inputOptionsPromise,
      // icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '<i class="fa fa-check"></i> Ok',
      cancelButtonText: '<i class="fa fa-close"></i> Close',
      showLoaderOnConfirm: true,
      preConfirm: (generate) => {
        return new Promise((resolve) => {
          setTimeout(() => {
            resolve()
          }, 2000)
        })
      },
      // allowOutsideClick: () => !Swal.isLoading()
      allowOutsideClick: false
    }).then((result) => {
      if(result.value)
      {        
        $.ajax({
          url: url,
          type: 'POST',
          data: {arrData:arrValue, ischecked:isChecked, id_order:id_order, docstatus:docStatus},
          success: function() {
            Swal.fire({
              // position: 'top-end',
              icon: 'success',
              title: 'Your data has been saved',
              showConfirmButton: false,
              timer: 1500
            })
            doSendEmail(id_order);
            $('#modal_order').modal('hide');
          }
        })
      }
    })
  }

  function doProgress(arrValue, isChecked) {
    var url = '<?php echo site_url('order/actUpdate') ?>';
    var docStatus = 'IP';
    $.ajax({
      url: url,
      type: 'POST',
      data: {arrData:arrValue, ischecked:isChecked, id_order:id_order, docstatus:docStatus},
      dataType: 'JSON',
      success: function(data) {
        if (data.success) {
          $.bootstrapGrowl(data.success, {
            type: 'success',
            offset: {from: 'top', amount: 50},
            width: 'auto'
          });
          $('#modal_order').modal('hide');
        }
      }
    });
  }  

  //function sending email
  function doSendEmail(getOrderId) {
    var url = '<?php echo site_url('email/actSend') ?>';
    $.ajax({
      url: url,
      type: 'POST',
      data: {id_order: getOrderId},
      dataType: 'JSON',
      success: function(data) {
      }
    })
  }

  //function difference two array
  function differenceOfArrays (arr1, arr2) {
    var results = [];
    arr1 = arr1.toString().split(',').map(Number);
    arr2 = arr2.toString().split(',').map(Number);

    for (var i in arr1) {
      if(arr2.indexOf(arr1[i]) === -1) {
        results.push(arr1[i]);
      }
    }

    for(i in arr2) {
      if(arr1.indexOf(arr2[i]) === -1) {
        results.push(arr2[i]);
      }
    }
    return results.sort((a,b) => a-b);
  }

  //function Array contains in array
  function containsAny(source,target) {
    var result = source.filter(function(item){ 
      return target.indexOf(item) > -1
    });   
    return (result.length > 0);
  }

  function getTotalQty() {
    var url = '<?php echo site_url('order/getTotalQty') ?>';
    var result = [];
    $.ajax({
      url: url,
      type: 'POST',
      data: {id_order:id_order},
      async: false,
      dataType: 'JSON',
      success: function(data) {
        result = data;
      }
    })
    return result;
  }

  //function to get id orderline qtycheck = qtyorder
  function getSameQtyId() {
    var url = '<?php echo site_url('order/getLineSameQty') ?>';
    var setLineId = [];    
    $.ajax({
      url: url,
      type: 'POST',
      data: {id_order:id_order},
      async: false,
      dataType: 'JSON',
      success: function(data) {
        setLineId = data;
      }
    });
    return setLineId;
  }

  //function get status order
  function getStatus(id_order) {
    var url = '<?php echo site_url('order/getStatus') ?>';
    var setStatus;    
    $.ajax({
      url: url,
      type: 'POST',
      data: {id_order:id_order},
      async: false,
      dataType: 'JSON',
      success: function(data) {
        setStatus = data;
      }
    });
    return setStatus;
  }

  //function get id from qty input zero
  function getQtyZero(values) {
    var url = '<?php echo site_url('order/getLineProcessed') ?>';
    var arrProcessed = [];
    var arrQtyZero = [];

    $.ajax({
      url: url,
      type: 'POST',
      data: {id_order:id_order},
      async: false,
      dataType: 'JSON',
      success: function(data) {
        arrProcessed = data;
      }
    });

    for(var i in values) {
      var qtyChecked = values[i].qty;
      var id_line = values[i].id_orderline;

      if (qtyChecked == 0 && arrProcessed.includes(id_line) == true)
      {
        arrQtyZero.push(id_line);
      }
    }
    return arrQtyZero;
  }

  //function get qty reserved
  function isQtyReserved(getLineId) {
    var url = '<?php echo site_url('order/getQtyReserved') ?>';
    var isQty = [];
    $.ajax({
      url: url,
      type: 'POST',
      data: {id_line:getLineId},
      async: false,
      dataType: 'JSON',
      success: function(data) {
        isQty = data;
      }
    });
    return isQty;
  }

  //function greater than quantity input and qty reserved
  function greaterThanQty(arr1,arr2) {
    var finalArr = [];

    for(var i in arr1) {
      for (var j in arr2) {
        arrQty1 = (arr1[i].qty).toString().split(',').map(Number);
        arrQty2 = (arr2[j].qtyres).toString().split(',').map(Number);
        arrQtyOrder = (arr2[j].qtyorder).toString().split(',').map(Number);

        if (arr1[i].id_orderline == arr2[j].id) {
          var arrQtyCheck = new Number(arr2[j].qtycheck);
          var getArrQty = new Number(arr1[i].qty);
          var amtQty = arrQtyCheck + getArrQty;

          var valuesQty = arrQty1.filter(function (items) {
            return (items > arrQty2 || amtQty > arrQtyOrder);
          });

          for (var k in valuesQty) {
            finalArr.push({isnum:arr2[j].isnum, qtyres:arr2[j].qtyres, qty:valuesQty[k]});
          }
        }
      }
    }
    return finalArr;
  }

  // function total qtychecked sama dengan total qtyorder
  function getSameTotalQty(arr1,arr2,totalQtyOrder) {
    var value = [];
    var arrTotalCheck = [];
    for (var i in arr1)
    {
      for(var k in arr2)
      {
        var qtyCheked = new Number (arr1[i].qty);
        var qtyChecking = new Number (arr2[k].qtycheck);
        var qtyCheckTotal =  (qtyCheked + qtyChecking);

        if(arr1[i].id_orderline.includes(arr2[k].id))
        {
          arrTotalCheck.push(qtyCheckTotal);
          // arrTotalOrder.push(qtyOrder);
        }
      }
    }

    if (arrSum(arrTotalCheck) == totalQtyOrder) 
    {
      value = true;
    } else {
      value = false;
    }
    return value;
  }

  // function sum value from array
  function arrSum(arrValue) {
    return arrValue.reduce(function(a,b) { 
      return a + b 
    }, 0);
  }

  //function setnumber minimum
  function numberMin() {
    $('input[type="number"]').on('input', function () {
      var value = $(this).val();
      if ((value !== '')) {
        $(this).val(Math.max(value, 0));
      } else if ((value == '')){
        $(this).val(0);
      }
    });
  }

  //clear input or html
  function resetOrder() {
    $('#modal_order').on('hidden.bs.modal', function() {
      // $('#alert_message').html('');
    });
  }

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('5055f508296afb487307', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    var docno = data.docno.bold();

    if (data.message === 'success') {
      var notif = '<h4><i class="icon fa fa-info"></i> Success!</h4> Document No : '+docno+' has been generated!';

      $.bootstrapGrowl(notif, {
        type: 'success',
        width: 'auto',
        offset: {from: 'bottom', amount: 20},
        delay: 10000
      });

      reloadOrder();
      totalInProgress();
      totalCompleted();

    } else {
      reloadOrder();
      totalInProgress();
      totalCompleted();
    }
  });
</script>