$(".custom-file input").change(function(e) {
    $(this).next(".custom-file-label").html(e.target.files[0].name);
});

if($('#style-3').length) {
    var table = $('#style-3').DataTable({
        "language": {
            "loadingRecords": "جارٍ التحميل...",
            "lengthMenu": "أظهر _MENU_ مدخلات",
            "zeroRecords": "لم يعثر على أية سجلات",
            "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "search": "ابحث:",
            "paginate": {
                "first": "الأول",
                "previous": "السابق",
                "next": "التالي",
                "last": "الأخير"
            },
            "aria": {
                "sortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                "sortDescending": ": تفعيل لترتيب العمود تنازلياً"
            },
            "select": {
                "rows": {
                    "_": "%d قيمة محددة",
                    "1": "1 قيمة محددة"
                },
                "cells": {
                    "1": "1 خلية محددة",
                    "_": "%d خلايا محددة"
                },
                "columns": {
                    "1": "1 عمود محدد",
                    "_": "%d أعمدة محددة"
                }
            },
            "buttons": {
                "print": "طباعة",
                "copyKeys": "زر <i>ctrl<\/i> أو <i>⌘<\/i> + <i>C<\/i> من الجدول<br>ليتم نسخها إلى الحافظة<br><br>للإلغاء اضغط على الرسالة أو اضغط على زر الخروج.",
                "pageLength": {
                    "-1": "اظهار الكل",
                    "_": "إظهار %d أسطر",
                    "1": "اظهار سطر واحد"
                },
                "collection": "مجموعة",
                "copy": "نسخ",
                "copyTitle": "نسخ إلى الحافظة",
                "csv": "CSV",
                "excel": "Excel",
                "pdf": "PDF",
                "colvis": "إظهار الأعمدة",
                "colvisRestore": "إستعادة العرض",
                "copySuccess": {
                    "1": "تم نسخ سطر واحد الى الحافظة",
                    "_": "تم نسخ %ds أسطر الى الحافظة"
                },
                "createState": "تكوين حالة",
                "removeAllStates": "ازالة جميع الحالات",
                "removeState": "ازالة حالة",
                "renameState": "تغيير اسم حالة",
                "savedStates": "الحالات المحفوظة",
                "stateRestore": "استرجاع حالة",
                "updateState": "تحديث حالة"
            },
            "searchBuilder": {
                "add": "اضافة شرط",
                "clearAll": "ازالة الكل",
                "condition": "الشرط",
                "data": "المعلومة",
                "logicAnd": "و",
                "logicOr": "أو",
                "value": "القيمة",
                "conditions": {
                    "date": {
                        "after": "بعد",
                        "before": "قبل",
                        "between": "بين",
                        "empty": "فارغ",
                        "equals": "تساوي",
                        "notBetween": "ليست بين",
                        "notEmpty": "ليست فارغة",
                        "not": "ليست "
                    },
                    "number": {
                        "between": "بين",
                        "empty": "فارغة",
                        "equals": "تساوي",
                        "gt": "أكبر من",
                        "lt": "أقل من",
                        "not": "ليست",
                        "notBetween": "ليست بين",
                        "notEmpty": "ليست فارغة",
                        "gte": "أكبر أو تساوي",
                        "lte": "أقل أو تساوي"
                    },
                    "string": {
                        "not": "ليست",
                        "notEmpty": "ليست فارغة",
                        "startsWith": " تبدأ بـ ",
                        "contains": "تحتوي",
                        "empty": "فارغة",
                        "endsWith": "تنتهي ب",
                        "equals": "تساوي",
                        "notContains": "لا تحتوي",
                        "notStartsWith": "لا تبدأ بـ",
                        "notEndsWith": "لا تنتهي بـ"
                    },
                    "array": {
                        "equals": "تساوي",
                        "empty": "فارغة",
                        "contains": "تحتوي",
                        "not": "ليست",
                        "notEmpty": "ليست فارغة",
                        "without": "بدون"
                    }
                },
                "button": {
                    "0": "فلاتر البحث",
                    "_": "فلاتر البحث (%d)"
                },
                "deleteTitle": "حذف فلاتر",
                "leftTitle": "محاذاة يسار",
                "rightTitle": "محاذاة يمين",
                "title": {
                    "0": "البحث المتقدم",
                    "_": "البحث المتقدم (فعال)"
                }
            },
            "searchPanes": {
                "clearMessage": "ازالة الكل",
                "collapse": {
                    "0": "بحث",
                    "_": "بحث (%d)"
                },
                "count": "عدد",
                "countFiltered": "عدد المفلتر",
                "loadMessage": "جارِ التحميل ...",
                "title": "الفلاتر النشطة",
                "showMessage": "إظهار الجميع",
                "collapseMessage": "إخفاء الجميع",
                "emptyPanes": "لا يوجد مربع بحث"
            },
            "infoThousands": ",",
            "datetime": {
                "previous": "السابق",
                "next": "التالي",
                "hours": "الساعة",
                "minutes": "الدقيقة",
                "seconds": "الثانية",
                "unknown": "-",
                "amPm": [
                    "صباحا",
                    "مساءا"
                ],
                "weekdays": [
                    "الأحد",
                    "الإثنين",
                    "الثلاثاء",
                    "الأربعاء",
                    "الخميس",
                    "الجمعة",
                    "السبت"
                ],
                "months": [
                    "يناير",
                    "فبراير",
                    "مارس",
                    "أبريل",
                    "مايو",
                    "يونيو",
                    "يوليو",
                    "أغسطس",
                    "سبتمبر",
                    "أكتوبر",
                    "نوفمبر",
                    "ديسمبر"
                ]
            },
            "editor": {
                "close": "إغلاق",
                "create": {
                    "button": "إضافة",
                    "title": "إضافة جديدة",
                    "submit": "إرسال"
                },
                "edit": {
                    "button": "تعديل",
                    "title": "تعديل السجل",
                    "submit": "تحديث"
                },
                "remove": {
                    "button": "حذف",
                    "title": "حذف",
                    "submit": "حذف",
                    "confirm": {
                        "_": "هل أنت متأكد من رغبتك في حذف السجلات %d المحددة؟",
                        "1": "هل أنت متأكد من رغبتك في حذف السجل؟"
                    }
                },
                "error": {
                    "system": "حدث خطأ ما"
                },
                "multi": {
                    "title": "قيم متعدية",
                    "restore": "تراجع",
                    "info": "القيم المختارة تحتوى على عدة قيم لهذا المدخل. لتعديل وتحديد جميع القيم لهذا المدخل، اضغط او انتقل هنا، عدا ذلك سيبقى نفس القيم",
                    "noMulti": "هذا المدخل مفرد وليس ضمن مجموعة"
                }
            },
            "processing": "جارٍ المعالجة...",
            "emptyTable": "لا يوجد بيانات متاحة",
            "infoEmpty": "يعرض 0 إلى 0 من أصل 0 مُدخل",
            "thousands": ".",
            "stateRestore": {
                "creationModal": {
                    "columns": {
                        "search": "إمكانية البحث للعمود",
                        "visible": "إظهار العمود"
                    },
                    "toggleLabel": "تتضمن",
                    "button": "تكوين الحالة",
                    "name": "اسم الحالة",
                    "order": "فرز",
                    "paging": "تصحيف",
                    "scroller": "مكان السحب",
                    "search": "بحث",
                    "searchBuilder": "مكون البحث",
                    "select": "تحديد",
                    "title": "تكوين حالة جديدة"
                },
                "duplicateError": "حالة مكررة بنفس الاسم",
                "emptyError": "لا يسمح بأن يكون اسم الحالة فارغة.",
                "emptyStates": "لا توجد حالة محفوظة",
                "removeConfirm": "هل أنت متأكد من حذف الحالة %s؟",
                "removeError": "لم استطع ازالة الحالة.",
                "removeJoiner": "و",
                "removeSubmit": "حذف",
                "removeTitle": "حذف حالة",
                "renameButton": "تغيير اسم حالة",
                "renameLabel": "الاسم الجديد للحالة %s:",
                "renameTitle": "تغيير اسم الحالة"
            },
            "autoFill": {
                "cancel": "إلغاء الامر",
                "fill": "املأ كل الخلايا بـ <i>%d<\/i>",
                "fillHorizontal": "تعبئة الخلايا أفقيًا",
                "fillVertical": "تعبئة الخلايا عموديا",
                "info": "تعبئة تلقائية"
            },
            "decimal": ",",
            "infoFiltered": "(مرشحة من مجموع _MAX_ مُدخل)",
            "searchPlaceholder": "مثال بحث"
        } ,
        "searching": false,
        "stripeClasses": [],
        "info" : false,
        "paging" :false,
        "ordering": false,
        "aSorting": [],
    });

    $('#style-3').wrap('<div class="dataTables_scroll" />');
    $('#style-3').css('transform', 'rotateX(180deg)');
}

$(".add-faq").click(function() {
    var copy = $(".faq__copy_item").html();
    var element = "<div class='faq__item'>" + copy + "</div>"
    $(".faq__holder").append(element)
})

$(".faq__holder").on("click", ".remove-faq", function() {
    $(this).parent().parent().parent().remove()
})
$(".add-project-detail").on("click", function() {
    var elm = $(".project-detail-copy-item").html();
    $(".project-details-holder").append(elm)
    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
})


$(".select-country").on("change", function() {
    var country = $(this).val();
    $(".select-city").html()
   
    // Clear selected items and destroy Select2 if initialized
    if ($(".select-city").hasClass("select2-hidden-accessible")) {
        $(".select-city").val(null).trigger('change'); // Clear selected items
        $(".select-city").select2('destroy');
    }
    if(country) {
        $.ajax({
            url:"/admin/countries/"+country+"/cities",
            method:"GET",
            data:{country:country},
            success:function(data){
                data.forEach(function(city){
                    $(".select-city").append(`<option selected value="${city.id}">${city.title.ar}</option>`)
                })
                $(".select-city").select2({
                    dir: "rtl",
                    width: '100%',
                    dropdownAutoWidth: true,
                    dropdownParent: $(".select-city").parent()
                });
            }
        })
    }
})

if($("#cars-uploader").length) {
    $("div#cars-uploader").dropzone(
        { 
            url: $("#cars-form").attr('action'),
            paramName:"files",
            autoProcessQueue: false,
            acceptedFiles: 'image/*',
            uploadMultiple: true,
            addRemoveLinks: true,
            dictRemoveFile: 'حذف',
            init: function() {
                var myDropzone = this;


                $("#cars-form").on('submit', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $(".submit-btn").attr('disabled', true);
                    $(".submit-btn").html('انتظر ...')
                    $(".submit-btn").css('opacity', '0.5')


                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    } else {
                        myDropzone._uploadData(
                            [
                                {
                                    upload: {
                                        filename: '' 
                                    }
                                }
                            ],
                            [
                                {
                                    filename: '',
                                    name: '',
                                    data: new Blob()
                                }
                            ]
                        );
                    }
                    $('.dz-error-message').html("");
                    
                })

                this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                        $('.dz-error-message').html("");
                });

                this.on('addedfile', function(file){
                    $('.dz-error-message').html("");
                });

                this.on('error', function(file, response) {
                    this.removeAllFiles();
                    console.log(response.errors)
                    var errors = '<i class="fas fa-exclamation-triangle"></i> <div>';
                    if(response.errors) {
                        for (const key in response.errors) {
                            response.errors[key].forEach((err) => {
                                errors = errors + err + " <br/>";
                            })
                        }
                    }else {
                        errors = errors + "الملف غير مدعوم"
                    }
                    errors = errors + "</div>"
                    
                    $('.dz-error-message').html(errors);
                    
                });

                this.on('sending', function(file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#cars-form').serializeArray();
                    $.each(data, function(key, el) {
                        
                        formData.append(el.name, el.value);
                        
                    });
                    // formData.append('content_description_ar', $("textarea[name='content_description_ar']").val())
                    // formData.append('content_description_en', $("textarea[name='content_description_en']").val())
                    
                    if($('input[type=file]')[0].files[0]) {
                        formData.append('image', $('input[type=file]')[0].files[0]);
                    }
                    if ($('input[type=file]')[1] && $('input[type=file]')[1].files.length > 0) {
                        formData.append('content_image', $('input[type=file]')[1].files[0]);
                    }
                    if ($('input[type=file]')[2] && $('input[type=file]')[2].files.length > 0) {
                        formData.append('content_image_2', $('input[type=file]')[2].files[0]);
                    }
                    if ($('input[type=file]')[3] && $('input[type=file]')[3].files.length > 0) {
                        formData.append('content_image_3', $('input[type=file]')[3].files[0]);
                    }
                
                });

                this.on("success", function(file, response) {
                   window.location.href = "/admin/cars?type=" + $("#cars-form").attr('data-type')
                })
            },

        }
    );
}

// $('.js-example-basic-single').select2();
$('select').each(function() {
    $(this).select2({
        dir: "rtl",
        width: '100%',
    dropdownAutoWidth: true,
        dropdownParent: $(this).parent()
    });
});

$(".select-brand").on("change", function() {
    var brand = $(this).val();
    $(".select-model").select2('destroy'); 
    $(".select-model").off('select2:select');
    $(".select-model").html("")
    if(brand) {
        $.ajax({
            url:"/admin/cars/"+brand+"/models",
            method:"GET",
            success:function(data){
                $(".select-model").append(`<option value="">اختر الموديل</option>`)
                data.forEach(function(model){
                    $(".select-model").append(`<option value="${model.id}">${model.name}</option>`)
                })
                $(".select-model").select2({
                    dir: "rtl",
                    width: '100%',
                    dropdownAutoWidth: true,
                    dropdownParent: $(".select-model").parent()
                });
            }
        })
    }
})

$(".home-period-filter").on("change", function() {
    $("#home-filter").submit();
})


// cars table

    if($("#datatable-cars").length) {
        var selectedCars = [];

        var cars = $("#datatable-cars").DataTable({
            dom: 'Bfrtip',
            paging: false,
            searching:false,
            sort:false,
            info:false,
            responsive:false,
            "aaSorting": [],
            buttons: [
                {
                    text: '<i class="fas fa-sync-alt"></i> تحديث',
                    action: function () {
                        let count = cars.rows({ selected: true }).count();
                        if(count == 0 ) {
                            alert("قم بتحديد السيارات اولا")
                        }else {
                            $("#cars-list").submit()
                        }
                    }
                },
            ],
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0,
                checkboxes: {
                    selectRow: true
                }
            }],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            
        })

        cars.on( 'select', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {
                var node = dt.rows( indexes ).nodes()[0];
                var id  =  $(node).attr("data-id");
                $(node).find('input').prop('checked', true);
                selectedCars.push(id)
                console.log(selectedCars)
            }
        } );

        cars.on( 'deselect', function ( e, dt, type, indexes ) {
            if ( type === 'row' ) {
                var node = dt.rows( indexes ).nodes()[0];
                var id  =  $(node).attr("data-id");
                selectedCars = selectedCars.filter(item => item !== id)
                $(node).find('input').prop('checked', false);
                console.log(selectedCars)
            }
        } );

        $('#datatable-cars').wrap('<div class="dataTables_scroll" />');
        $('#datatable-cars').css('transform', 'rotateX(180deg)');

    }