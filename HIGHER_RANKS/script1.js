
$(document).ready(function () {

    $('.editbtn').on('click', function () {

        $('#editmodal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_idsyslabus').val(data[0]);
        $('#course_code').val(data[1]);
        $('#course_tittle').val(data[2]);

        // Auto check checkbox for course_Type
        var courseType = data[3];
        $('input[name="course_Type"][value="' + courseType + '"]').prop('checked', true);

        $('#course_credit').val(data[4]);

        // Auto check checkbox for learning_modality
        var learningModality = data[5];
        $('input[name="learning_modality"][value="' + learningModality + '"]').prop('checked', true);

        $('#pre_requisit').val(data[6]);
        $('#co_pre_requisit').val(data[7]);
        $('#professor').val(data[8]);
        $('#consultation_hours_date').val(data[9]);
        $('#consultation_hours_room').val(data[10]);
        $('#consultation_hours_email').val(data[11]);
        $('#consultation_hours_number').val(data[12]);
        $('#course_description').val(data[13]);
    });
});





$(document).ready(function () {

    $('.editbtn_learning_out').on('click', function () {

        $('#editmodal_learn_out').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id').val(data[0]);
        $('#comlab').val(data[1]);
        $('#learn_out').val(data[3]);
    });
});



$(document).ready(function () {

    $('.editbtn_learning_out_table').on('click', function () {

        $('#editmodal_learn_out_table').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id1').val(data[0]);
        $('#comlab1').val(data[1]);
        $('#learn_out1').val(data[3]);
        $('#topic_learn_out1').val(data[4]);
    });
});










    $(document).ready(function () {

        $('.deletebtn_learning_out').on('click', function () {

            $('#deletemodal_learning_out').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);

        });
    });




    $(document).ready(function () {

        $('.deletebtn_module_learning').on('click', function () {

            $('#deletemodal_module_learning').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id3').val(data[0]);

        });
    });





$(document).ready(function () {
    $('.editbtn_module_learning').on('click', function () {
        $('#editmodal_module_learning').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        console.log(data);
        $('#update_id3').val(data[0]);
        $('#module_no').val(data[1]);
        $('#title').val(data[2]);
        $('#week').val(data[3]);
        $('#date').val(data[4]);
        $('#teaching_activities').val(data[5]);
        $('#technology').val(data[6]);
        
        // Handling the 'onsite' checkbox
        var onsite = data[7];
        if (onsite === '/') {
            $('input[name="onsite"]').prop('checked', true);
        } else {
            $('input[name="onsite"]').prop('checked', false);
        }
        
        // Handling the 'asy' checkbox
        var asy = data[8];
        if (asy === '/') {
            $('input[name="asy"]').prop('checked', true);
        } else {
            $('input[name="asy"]').prop('checked', false);
        }

        $('#alloted_hours').val(data[9]);
    });
});





$(document).ready(function () {

    $('.editbtn_module_learning_final').on('click', function () {

        $('#editmodal_module_learning_final').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id15').val(data[0]);
        $('#1module_no').val(data[1]);
        $('#1week').val(data[2]);    

        // Auto check checkbox for course_Type
        
        $('#1date').val(data[3]);
        $('#1teaching_activities').val(data[4]);
        $('#1technology').val(data[5]);
        var onsite1 = data[6];
        if (onsite1 === '/') {
            $('input[name="onsite1"]').prop('checked', true);
        } else {
            $('input[name="onsite1"]').prop('checked', false);
        }
        
        // Handling the 'asy' checkbox
        var asy1 = data[7];
        if (asy1 === '/') {
            $('input[name="asy1"]').prop('checked', true);
        } else {
            $('input[name="asy1"]').prop('checked', false);
        }

        $('#alloted_hours2').val(data[8]);

    });
});




    $(document).ready(function () {

        $('.deletebtn_module_learning_final').on('click', function () {

            $('#deletemodal_module_learning_final').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id15').val(data[0]);

        });
    });


// <!-- EDIT BTN FOR FINAL PERIOD TABLE -->


$(document).ready(function () {

    $('.editbtn_learning_out_final_period_table').on('click', function () {

        $('#editmodal_learn_out__final_period_table').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id5').val(data[0]);
        $('#comlab_6').val(data[1]);
        $('#final_learning_out').val(data[3]);
        $('#final_topic_leaning_out').val(data[4]);
    });
});


// <!-- DELETE BTN FOR FINAL PERIOD TABLE -->


    $(document).ready(function () {

        $('.deletebtn_learning_out_final_period_table').on('click', function () {

            $('#deletemodal_learn_out__final_period_table').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id6').val(data[0]);

        });
    });



// <!-- EDIT BTN FOR ONSITE REFFERENCE -->


$(document).ready(function () {

    $('.editbtn_onsite_reffence').on('click', function () {

        $('#editmodal_onsite_reffence').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id6').val(data[0]);
        $('#Provider').val(data[1]);
        $('#Reference_Material').val(data[2]);
    });
});


// <!-- DELETE BTN FOR ONSITE REFFERENCE -->


    $(document).ready(function () {

        $('.deletebtn_onsite_refference').on('click', function () {

            $('#deletemodal_onsite_refference').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id7').val(data[0]);

        });
    });




// <!-- EDIT BTN FOR ONSITE REFFERENCE -->


$(document).ready(function () {

    $('.editbtn_online_refference').on('click', function () {

        $('#editmodal_online_refference').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id8').val(data[0]);
        $('#e_provider').val(data[1]);
        $('#refference_material').val(data[2]);
    });
});


// <!-- DELETE BTN FOR ONSITE REFFERENCE -->


    $(document).ready(function () {

        $('.deletebtn_online_refference').on('click', function () {

            $('#deletemodal_online_refference').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id8').val(data[0]);

        });
    });




// <!-- EDIT BTN FOR SEMESTRAL -->


$(document).ready(function () {

    $('.editbtn_semestral').on('click', function () {

        $('#editmodal_semestral').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id9').val(data[0]);
        $('#term').val(data[1]);
        $('#year').val(data[2]);
    });
});




$(document).ready(function () {
    $('.editbtn_signature').on('click', function () {
        $('#editmodal_signature').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $('#update_id22').val(data[0]);
        // Clear any previously selected file
        $('#dept_signature').val('');
    });

    // Preview the selected image
    $('#dept_signature').change(function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview_dept_signature').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#preview_dept_signature').hide();
        }
    });
});



$(document).ready(function () {
    $('.editbtn_signature_dean').on('click', function () {
        $('#editmodal_signature_dean').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();
        $('#update_id23').val(data[0]);
        // Clear any previously selected file
        $('#dean_signature').val('');
    });

    // Preview the selected image
    $('#dean_signature').change(function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview_dean_signature').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#preview_dean_signature').hide();
        }
    });
});



$(document).ready(function () {

    $('.editbtn_signature_committee').on('click', function () {
        $('#editmodal_status_commitee').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id45').val(data[0]);
        $('#commitee_signature').val(data[1]);
        $('#commitee_comment6').val(data[2]);
    });
});




// <!-- EDIT BTN FOR MAPPING TABLE PLS -->


$(document).ready(function () {

    $('.editbtn_mapping_tablepls').on('click', function () {

        $('#editmodal_mapping_tablespls').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id10').val(data[0]);
        $('#learn_out_mapping').val(data[1]);
        var pl1 = data[2];
        if (pl1 === '/'){
            $('input[name="pl1"]').prop('checked', true);
        }else{
            $('input[name="pl1"]').prop('checked', false);
        }
        var pl2 = data[3];
        if (pl2 === '/'){
            $('input[name="pl2"]').prop('checked', true);
        }else{
            $('input[name="pl2"]').prop('checked', false);
        }

        var pl3 = data[4];
        if (pl3 === '/'){
            $('input[name="pl3"]').prop('checked', true);
        }else{
            $('input[name="pl3"]').prop('checked', false);
        }

        var pl4 = data[5];
        if (pl4 === '/'){
            $('input[name="pl4"]').prop('checked', true);
        }else{
            $('input[name="pl4"]').prop('checked', false);
        }

        var pl5 = data[6];
        if (pl5 === '/'){
            $('input[name="pl5"]').prop('checked', true);
        }else{
            $('input[name="pl5"]').prop('checked', false);
        }

        var pl6 = data[7];
        if (pl6 === '/'){
            $('input[name="pl6"]').prop('checked', true);
        }else{
            $('input[name="pl6"]').prop('checked', false);
        }

        var pl7 = data[8];
        if (pl7 === '/'){
            $('input[name="pl7"]').prop('checked', true);
        }else{
            $('input[name="pl7"]').prop('checked', false);
        }

        var pl8 = data[9];
        if (pl8 === '/'){
            $('input[name="pl8"]').prop('checked', true);
        }else{
            $('input[name="pl8"]').prop('checked', false);
        }
        
        var pl9 = data[10];
        if (pl9 === '/'){
            $('input[name="pl9"]').prop('checked', true);
        }else{
            $('input[name="pl9"]').prop('checked', false);
        }
        
        
        


      
    });
});





    $(document).ready(function () {

        $('.deletebtn_mapping_tablepls').on('click', function () {

            $('#deletemodal_mapping_tablepls').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id10').val(data[0]);

        });
    });





$(document).ready(function () {

    $('.editbtn_decriptors').on('click', function () {

        $('#editmodal_decriptors').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id11').val(data[0]);
        $('#program_learn').val(data[1]);
        var rate1 = data[2];
        if (rate1 === '/'){
            $('input[name="rate1"]').prop('checked', true);
        }else{
            $('input[name="rate1"]').prop('checked', false);
        }

        var rate2 = data[3];
        if (rate2 === '/'){
            $('input[name="rate2"]').prop('checked', true);
        }else{
            $('input[name="rate2"]').prop('checked', false);
        }

        var rate3 = data[4];
        if (rate3 === '/'){
            $('input[name="rate3"]').prop('checked', true);
        }else{
            $('input[name="rate3"]').prop('checked', false);
        }

        var rate4 = data[5];
        if (rate4 === '/'){
            $('input[name="rate4"]').prop('checked', true);
        }else{
            $('input[name="rate4"]').prop('checked', false);
        }

        var rate5 = data[6];
        if (rate5 === '/'){
            $('input[name="rate5"]').prop('checked', true);
        }else{
            $('input[name="rate5"]').prop('checked', false);
        }
        


      
    });
});




    $(document).ready(function () {

        $('.deletebtn_decriptors').on('click', function () {

            $('#deletemodal_decriptors').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id11').val(data[0]);

        });
    });




$(document).ready(function () {

    $('.editbtn_graduate_attributes').on('click', function () {

        $('#editmodal_graduate_attributes').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id12').val(data[0]);
        $('#graduate_att').val(data[1]);
        $('#descriptors_learn_out').val(data[2]);
    });
});





    $(document).ready(function () {

        $('.deletebtn_graduate_attributes').on('click', function () {

            $('#deletemodal_graduate_attributes').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id12').val(data[0]);

        });
    });




$(document).ready(function () {

    $('.editbtn_percentage').on('click', function () {

        $('#editmodal_percentage').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id20').val(data[0]);
        $('#description').val(data[1]);
        $('#percents').val(data[2]);
    });
});



$(document).ready(function () {

    $('.final_editbtn_percentage').on('click', function () {

        $('#final_editmodal_percentage').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id50').val(data[0]);
        $('#final_description').val(data[1]);
        $('#final_percents').val(data[2]);
    });
});



$(document).ready(function () {

    $('.editbtn_course_policies').on('click', function () {

        $('#editmodal_course_policies').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#update_id51').val(data[0]);
        $('#title').val(data[1]);
        $('#description').val(data[2]);
    });
});



// <!-- DELETE BTN FOR PERCENTAGE -->


    $(document).ready(function () {

        $('.deletebtn_percentage').on('click', function () {

            $('#deletemodal_percentage').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id20').val(data[0]);

        });
    });


// <!-- DELETE BTN FOR PERCENTAGE -->


$(document).ready(function () {

    $('.final_deletebtn_percentage').on('click', function () {

        $('#final_deletemodal_percentage').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#delete_id50').val(data[0]);

    });
});




function goback() {
    window.history.back();
}
