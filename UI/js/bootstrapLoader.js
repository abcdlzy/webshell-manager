/**
 * Created by abcdlzy on 15/2/16.
 */
function reloadBootstrap(){

    // Initialize card flip
    $('.card.hover').hover(function(){
        $(this).addClass('flip');
    },function(){
        $(this).removeClass('flip');
    });

    //show tooltips
    $('#topTooltip, #rightTooltip, #bottomTooltip, #leftTooltip').tooltip();

    //jGrowl notifications
    $("#defaultGrowl").click(function() {
        $.jGrowl("Hello world!");
    });

    $("#stickyGrowl").click(function() {
        $.jGrowl("Stick this!", { sticky: true });
    });

    $("#headerGrowl").click(function() {
        $.jGrowl("A message with a header", { header: 'Important' });
    });

    $("#longerGrowl").click(function() {
        $.jGrowl("A message that will live a little longer.", { life: 10000 });
    });

    $("#specialGrowl").click(function() {
        $.jGrowl("A message with a beforeClose callback and a different opening animation.", {
            beforeClose: function(e,m) {
                alert('About to close this notification!');
            },
            animateOpen: {
                height: 'show'
            }
        });
    });

    // Initialize tabDrop
    $('.tabdrop').tabdrop({text: '<i class="fa fa-th-list"></i>'});

    //initialize typeahead
    $('#typeahead').typeahead({
        name: 'States',
        local: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
    });

    //initialize datepicker
    $('#datepicker').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });

    $("#datepicker").on("dp.show",function (e) {
        var newtop = $('.bootstrap-datetimepicker-widget').position().top - 45;
        $('.bootstrap-datetimepicker-widget').css('top', newtop + 'px');
    });

    //initialize chosen
    $(".chosen-select").chosen({disable_search_threshold: 10});

    //initialize range slider
    $('#rangeSlider').noUiSlider({
        range: [10,40],
        start: [20,30],
        connect: true
    });

    //initialize slider
    $('#slider').noUiSlider({
        range: [0,100],
        start: [20],
        handles: 1
    });

    //initialize color picker sliders
    $('.slider').noUiSlider({
        range: [0,255]
        ,start: 127
        ,handles: 1
        ,connect: "lower"
        ,orientation: "vertical"
        ,serialization: {
            resolution: 1
        }
        ,slide: function(){

            var color = 'rgb(' + $("#red").val()
                + ',' + $("#green").val()
                + ',' + $("#blue").val()
                + ')';

            $(".result").css({
                background: color
                ,color: color
            });
        }
    });

    //set width for label on Inline Select
    var setLabelWidth = function() {
        var parentWidth = $('.inlineSelect.inline').width();
        var childrenLength = $('.inlineSelect.inline li').length;

        $('.inlineSelect.inline li label, .inlineSelect.inline li.title').css('width', ((parentWidth / childrenLength)) + 'px');
    }

    setLabelWidth();

    $(window).resize(function() {
        setLabelWidth();
    });

    //accordion class active toggling
    $('#accordion .panel-heading .panel-title a').click(function() {

        var $previous = $( '#accordion .panel.active' );

        $previous.removeClass('active');
        $(this).parent().parent().parent().stop().addClass('active');

        if($(this).parent().parent().parent().hasClass('active')) {
            $previous.removeClass('active');
        }
    });

    //multi-accordion class active toggling
    $('#multi-accordion .panel-heading .panel-title a').click(function() {
        $(this).parent().parent().parent().stop().toggleClass('active');
    });
}

function getTargetServerInfo(){
    getShellInfoArray();
}

function reloadDataTable(){
    //
    // Add custom class to pagination div
    $.fn.dataTableExt.oStdClasses.sPaging = 'dataTables_paginate paging_bootstrap paging_custom';

    /*************************************************/
    /**************** BASIC DATATABLE ****************/
    /*************************************************/

    /* Define two custom functions (asc and desc) for string sorting */
    jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
        return ((x < y) ? -1 : ((x > y) ?  1 : 0));
    };

    jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
        return ((x < y) ?  1 : ((x > y) ? -1 : 0));
    };

    /* Add a click handler to the rows - this could be used as a callback */
    $("#basicDataTable tbody tr").click( function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            oTable01.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }

        // FadeIn/Out delete rows button
        if ($('#basicDataTable tr.row_selected').length > 0) {
            $('#deleteRow').stop().fadeIn(300);
        } else {
            $('#deleteRow').stop().fadeOut(300);
        }
    });

    /* Build the DataTable with third column using our custom sort functions */
    var oTable01 = $('#basicDataTable').dataTable({
        "sDom":
        "<'row'<'col-md-4'l><'col-md-4 text-center sm-left'T C><'col-md-4'f>r>"+
        "t"+
        "<'row'<'col-md-4 sm-center'i><'col-md-4'><'col-md-4 text-right sm-center'p>>",
        "oLanguage": {
            "sSearch": ""
        },
        "aaSorting": [ [0,'asc'], [1,'asc'] ],
        "aoColumns": [
            null,
            null,
            { "sType": 'string-case' },
            null,
            null
        ],
        "oTableTools": {
            "sSwfPath": "assets/js/vendor/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends":    "collection",
                    "sButtonText": '保存<span class="caret" />',
                    "aButtons":    [ "csv", "xls", "pdf" ]
                }
            ]
        },
        "oColVis": {
            "buttonText": '<i class="fa fa-eye"></i>'
        },
        "fnInitComplete": function(oSettings, json) {
            $('.dataTables_filter input').attr("placeholder", "搜索");
        }
    });

    // Append delete button to table
    var deleteRowLink = '<a href="#" id="deleteRow" class="btn btn-red btn-xs delete-row">Delete selected row</a>'
    $('#basicDataTable_wrapper').append(deleteRowLink);

    /* Add a click handler for the delete row */
    $('#deleteRow').click( function() {
        var anSelected = fnGetSelected(oTable01);
        if (anSelected.length !== 0 ) {
            oTable01.fnDeleteRow(anSelected[0]);
            $('#deleteRow').stop().fadeOut(300);
        }
    });

    /* Get the rows which are currently selected */
    function fnGetSelected(oTable01Local){
        return oTable01Local.$('tr.row_selected');
    };

}

function reloadChoosen(){
    $(".chosen-select").chosen({disable_search_threshold: 10});
}