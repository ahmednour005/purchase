
    // 1
    if($('#service_selected1').length){
        $('#service_selected1').select2();
        $('#product_selected1').select2();
        $('#service_selected1').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected1").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected1' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected1').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected1').empty();
                    response.forEach(element => {
                        $('#product_selected1').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 2
    if($('#service_selected2').length){
        $('#service_selected2').select2();
        $('#product_selected2').select2();
        $('#service_selected2').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected2").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected2' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected2').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected2').empty();
                    response.forEach(element => {
                        $('#product_selected2').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 3
    if($('#service_selected3').length){
        $('#service_selected3').select2();
        $('#product_selected3').select2();
        $('#service_selected3').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected3").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected3' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected3').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected3').empty();
                    response.forEach(element => {
                        $('#product_selected3').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    //4
    if($('#service_selected4').length){
        $('#service_selected4').select2();
        $('#product_selected4').select2();
        $('#service_selected4').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected4").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected4' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected4').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected4').empty();
                    response.forEach(element => {
                        $('#product_selected4').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 5
    if($('#service_selected5').length){
        $('#service_selected5').select2();
        $('#product_selected5').select2();
        $('#service_selected5').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected5").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected5' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected5').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected5').empty();
                    response.forEach(element => {
                        $('#product_selected5').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 6
    if($('#service_selected6').length){
        $('#service_selected6').select2();
        $('#product_selected6').select2();
        $('#service_selected6').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected6").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected6' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected6').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected6').empty();
                    response.forEach(element => {
                        $('#product_selected6').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 7
    if($('#service_selected7').length){
        $('#service_selected7').select2();
        $('#product_selected7').select2();
        $('#service_selected7').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected7").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected7' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected7').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected7').empty();
                    response.forEach(element => {
                        $('#product_selected7').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 8
    if($('#service_selected8').length){
        $('#service_selected8').select2();
        $('#product_selected8').select2();
        $('#service_selected8').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected8").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected8' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected8').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected8').empty();
                    response.forEach(element => {
                        $('#product_selected8').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }


    // 9
    if($('#service_selected9').length){
        $('#service_selected9').select2();
        $('#product_selected9').select2();
        $('#service_selected9').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected9").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected9' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected9').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected9').empty();
                    response.forEach(element => {
                        $('#product_selected9').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }


    // 10
    if($('#service_selected10').length){
        $('#service_selected10').select2();
        $('#product_selected10').select2();
        $('#service_selected10').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected10").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected10' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected10').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected10').empty();
                    response.forEach(element => {
                        $('#product_selected10').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }


    // 11
    if($('#service_selected11').length){
        $('#service_selected11').select2();
        $('#product_selected11').select2();
        $('#service_selected11').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected11").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected11' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected11').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected11').empty();
                    response.forEach(element => {
                        $('#product_selected11').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 12
    if($('#service_selected12').length){
        $('#service_selected12').select2();
        $('#product_selected12').select2();
        $('#service_selected12').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected12").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected12' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected12').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected12').empty();
                    response.forEach(element => {
                        $('#product_selected12').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }


    // 13
    if($('#service_selected13').length){
        $('#service_selected13').select2();
        $('#product_selected13').select2();
        $('#service_selected13').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected13").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected13' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected13').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected13').empty();
                    response.forEach(element => {
                        $('#product_selected13').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }



    // 14
    if($('#service_selected14').length){
        $('#service_selected14').select2();
        $('#product_selected14').select2();
        $('#service_selected14').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected14").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected14' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected14').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected14').empty();
                    response.forEach(element => {
                        $('#product_selected14').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 15
    if($('#service_selected15').length){
        $('#service_selected15').select2();
        $('#product_selected15').select2();
        $('#service_selected15').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected15").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected15' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected15').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected15').empty();
                    response.forEach(element => {
                        $('#product_selected15').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 16
    if($('#service_selected16').length){
        $('#service_selected16').select2();
        $('#product_selected16').select2();
        $('#service_selected16').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected16").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected16' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected16').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected16').empty();
                    response.forEach(element => {
                        $('#product_selected16').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 17
    if($('#service_selected17').length){
        $('#service_selected17').select2();
        $('#product_selected17').select2();
        $('#service_selected17').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected17").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected17' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected17').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected17').empty();
                    response.forEach(element => {
                        $('#product_selected17').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 18
    if($('#service_selected18').length){
        $('#service_selected18').select2();
        $('#product_selected18').select2();
        $('#service_selected18').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected18").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected18' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected18').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected18').empty();
                    response.forEach(element => {
                        $('#product_selected18').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }

    // 19
    if($('#service_selected19').length){
        $('#service_selected19').select2();
        $('#product_selected19').select2();
        $('#service_selected19').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected19").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected19' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected19').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected19').empty();
                    response.forEach(element => {
                        $('#product_selected19').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }


    // 20
    if($('#service_selected20').length){
        $('#service_selected20').select2();
        $('#product_selected20').select2();
        $('#service_selected20').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected20").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected20' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected20').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected20').empty();
                    response.forEach(element => {
                        $('#product_selected20').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }



    // 21
    if($('#service_selected21').length){
        $('#service_selected21').select2();
        $('#product_selected21').select2();
        $('#service_selected21').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected21").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected21' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected21').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected21').empty();
                    response.forEach(element => {
                        $('#product_selected21').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 22
    if($('#service_selected22').length){
        $('#service_selected22').select2();
        $('#product_selected22').select2();
        $('#service_selected22').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected22").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected22' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected22').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected22').empty();
                    response.forEach(element => {
                        $('#product_selected22').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 23
    if($('#service_selected23').length){
        $('#service_selected23').select2();
        $('#product_selected23').select2();
        $('#service_selected23').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected23").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected23' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected23').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected23').empty();
                    response.forEach(element => {
                        $('#product_selected23').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 24
    if($('#service_selected24').length){
        $('#service_selected24').select2();
        $('#product_selected24').select2();
        $('#service_selected24').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected24").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected24' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected24').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected24').empty();
                    response.forEach(element => {
                        $('#product_selected24').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 25
    if($('#service_selected25').length){
        $('#service_selected25').select2();
        $('#product_selected25').select2();
        $('#service_selected25').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected25").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected25' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected25').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected25').empty();
                    response.forEach(element => {
                        $('#product_selected25').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 26
    if($('#service_selected26').length){
        $('#service_selected26').select2();
        $('#product_selected26').select2();
        $('#service_selected26').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected26").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected26' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected26').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected26').empty();
                    response.forEach(element => {
                        $('#product_selected26').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 27
    if($('#service_selected27').length){
        $('#service_selected27').select2();
        $('#product_selected27').select2();
        $('#service_selected27').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected27").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected27' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected27').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected27').empty();
                    response.forEach(element => {
                        $('#product_selected27').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 28
    if($('#service_selected28').length){
        $('#service_selected28').select2();
        $('#product_selected28').select2();
        $('#service_selected28').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected28").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected28' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected28').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected28').empty();
                    response.forEach(element => {
                        $('#product_selected28').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 29
    if($('#service_selected29').length){
        $('#service_selected29').select2();
        $('#product_selected29').select2();
        $('#service_selected29').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected29").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected29' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected29').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected29').empty();
                    response.forEach(element => {
                        $('#product_selected29').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
    // 30
    if($('#service_selected30').length){
        $('#service_selected30').select2();
        $('#product_selected30').select2();
        $('#service_selected30').select2({
            allowClear: true,
            placeholder:"أختر الخدمة / النشاط"
        });
        $("#product_selected30").select2({
            placeholder: "أختر المنتجات"
        });

        $('#service_selected30' ).on('change', function () {
            let id = $(this).val();
            $('#product_selected30').empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#product_selected30').empty();
                    response.forEach(element => {
                        $('#product_selected30').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });
    }
