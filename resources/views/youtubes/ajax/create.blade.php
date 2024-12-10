<link rel="stylesheet" href="{{ asset('vendor/css/dropzone.min.css') }}">

<div class="row">
    <div class="col-sm-12">
        <x-form id="save-youtube-form">

            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal  border-bottom-grey">
                    @lang('app.menu.addYoutubes')</h4>
                <div class="row p-20">
                    <div class="col-lg-12">
                        <div class="row">

                            <input type="hidden" id="hiddenProductId">

                            <div class="col-lg-4 col-md-6">
                                <x-forms.text fieldId="name" :fieldLabel="__('app.name')" fieldName="name"
                                              fieldRequired="true" :fieldPlaceholder="__('placeholders.productName')">
                                </x-forms.text>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <x-forms.text fieldId="url" :fieldLabel="__('app.url')" fieldName="url"
                                              fieldRequired="true" :fieldPlaceholder="__('placeholders.url')">
                                </x-forms.text>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <x-forms.text fieldId="channel_code" :fieldLabel="__('app.channel_code')" fieldName="channel_code"
                                              fieldRequired="false" :fieldPlaceholder="__('placeholders.channel_code')">
                                </x-forms.text>
                            </div>


                            <div class="col-lg-4 col-md-6">
                                <x-forms.label class="my-3" fieldId=""
                                               :fieldLabel="__('app.region')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control select-picker" name="region" id="region" data-live-search="true">
                                        <option value="">--</option>
                                        <option value="1">Việt Nam</option>
                                    </select>
                                </x-forms.input-group>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <x-forms.label class="my-3" fieldId=""
                                               :fieldLabel="__('app.language')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control select-picker" name="language" id="language" data-live-search="true">
                                        <option value="">--</option>
                                        <option value="1">Tiếng Việt</option>
                                    </select>
                                </x-forms.input-group>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <x-forms.label class="my-3" fieldId="description-text"
                                                :fieldLabel="__('app.description')">
                                </x-forms.label>
                                <textarea name="description" id="description-text" rows="4"
                                            class="form-control"></textarea>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <x-forms.email fieldId="email_host_main" :fieldLabel="__('app.email_host_main')" fieldName="email_host_main"
                                              fieldRequired="true" :fieldPlaceholder="__('placeholders.email_host_main')">
                                </x-forms.email>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <x-forms.email fieldId="email_management" :fieldLabel="__('app.email_management')" fieldName="email_management"
                                              fieldRequired="false" :fieldPlaceholder="__('placeholders.email_management')">
                                </x-forms.email>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <x-forms.email fieldId="email_network" :fieldLabel="__('app.email_network')" fieldName="email_network"
                                              fieldRequired="false" :fieldPlaceholder="__('placeholders.email_network')">
                                </x-forms.email>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <x-forms.label class="my-3" fieldId=""
                                                fieldRequired="true"
                                               :fieldLabel="__('app.status')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control select-picker" name="status" id="status" data-live-search="true" required>
                                        <option value="">--</option>
                                        <option value="1">Tiếng Việt</option>
                                    </select>
                                </x-forms.input-group>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <x-forms.label class="my-3" fieldId=""
                                               :fieldLabel="__('app.network')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control select-picker" name="network" id="network" data-live-search="true">
                                        <option value="">--</option>
                                        <option value="1">Tiếng Việt</option>
                                    </select>
                                </x-forms.input-group>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <x-forms.number fieldId="profit_sharing_percent" :fieldLabel="__('app.profit_sharing_percent') . ' (%) '" fieldName="profit_sharing_percent"
                                              fieldRequired="false" :fieldPlaceholder="__('placeholders.profit_sharing_percent')">
                                </x-forms.number>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <x-forms.label class="my-3" fieldId=""
                                               :fieldLabel="__('app.channel_manager')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control select-picker" name="channel_manager" id="channel_manager" data-live-search="true">
                                        <option value="">--</option>
                                        <option value="1">Tiếng Việt</option>
                                    </select>
                                </x-forms.input-group>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <x-forms.label class="my-3" fieldId=""
                                               :fieldLabel="__('app.department_id')">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <select class="form-control select-picker" name="department_id" id="department_id" data-live-search="true">
                                        <option value="">--</option>
                                        <option value="1">Tiếng Việt</option>
                                    </select>
                                </x-forms.input-group>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <x-forms.label class="my-3" fieldId=""
                                               :fieldLabel="__('app.service_account')">
                                </x-forms.label>
                                <input type="hidden" id="service_account" name="service_account" value="" readonly>
                                <button type="button" id="authorize-youtube" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                                    Ủy quyền kênh YouTube
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <x-forms.custom-field :fields="$fields"></x-forms.custom-field>


                <x-form-actions>
                    <x-forms.button-primary id="save-product" class="mr-3" icon="check">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-secondary class="mr-3" id="save-more-product" icon="check-double">@lang('app.saveAddMore')
                    </x-forms.button-secondary>
                    <x-forms.button-cancel :link="route('products.index')" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>

    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog d-flex justify-content-center align-items-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">@lang('app.uploadfileServiceAccount')</h5>
                <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <x-form id="uploadServiceAccountFile">
                    <x-forms.file class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('app.service_account')"
                                fieldName="service_account_key_file" fieldId="service_account_key_file"
                                fieldRequired="true"/>
                </x-form>
            </div>
            <div class="modal-footer">
                <x-forms.button-cancel data-dismiss="modal" class="border-0 mr-3">@lang('app.cancel')</x-forms.button-cancel>
                <x-forms.button-primary id="login-google" icon="check">@lang('app.check')</x-forms.button-primary>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#save-more-product').click(function () {

            $('#add_more').val(true);

            const url = "{{ route('youtubes.store') }}";
            var data = $('#save-youtube-form').serialize();

            saveYoutube(data, url, "#save-more-product");

        });

        $('#save-product').click(function() {

            const url = "{{ route('youtubes.store') }}";
            var data = $('#save-youtube-form').serialize();

            saveYoutube(data, url, "#save-product");

        });

        function saveYoutube(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-youtube-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: buttonSelector,
                file: true,
                data: data,
                success: function(response) {
                    if (productDropzone.getQueuedFiles().length > 0) {
                        productID = response.productID
                        defaultImage = response.defaultImage;
                        $('#hiddenProductId').val(productID);
                        productDropzone.processQueue();
                    }
                    else if(response.add_more == true) {

                        var right_modal_content = $.trim($(RIGHT_MODAL_CONTENT).html());

                        if(right_modal_content.length) {

                            $(RIGHT_MODAL_CONTENT).html(response.html.html);
                            $('#add_more').val(false);
                        }
                        else {

                            $('.content-wrapper').html(response.html.html);
                            init('.content-wrapper');
                            $('#add_more').val(false);
                        }
                    }

                    else{
                        if (response.redirectUrl == 'no') {
                            getProductOptions();
                            closeTaskDetail();
                        } else if ($(MODAL_XL).hasClass('show')) {
                            $(MODAL_XL).modal('hide');
                            window.location.reload();
                        } else {
                            window.location.href = response.redirectUrl;
                        }
                    }

                    if (typeof showTable !== 'undefined' && typeof showTable === 'function') {
                            showTable();
                    }

                }
            });
        }

        $("#login-google").click(function () {
        var file = $("#service_account_key_file")[0].files[0];
        if (!file) {
            alert("Vui lòng upload file Service Account!");
            return;
        }

        // Đọc nội dung file JSON
        var reader = new FileReader();
        reader.onload = function (e) {
            var serviceAccount = e.target.result;

            // Lưu file JSON vào input hidden
            $("#service_account_file").val(serviceAccount);

            // Gửi request đến server để lấy URL đăng nhập Google
            $.ajax({
                url: "{{ route('youtubes.check-service-account') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    service_account: serviceAccount,
                },
                success: function (response) {
                    // Mở tab mới để người dùng đăng nhập Google
                    // Swal.fire({
                    //     icon: response.status,
                    //     text: response.message,
                    //     toast: true,
                    //     position: 'top-end',
                    //     timer: 3000,
                    //     timerProgressBar: true,
                    //     showConfirmButton: false,
                    //     customClass: {
                    //         confirmButton: 'btn btn-primary',
                    //     },
                    //     showClass: {
                    //         popup: 'swal2-noanimation',
                    //         backdrop: 'swal2-noanimation'
                    //     },
                    // })
                    // if(response.status == 'success') {
                    //     $('#service_account').val(serviceAccount);
                    // }
                    window.open(response.auth_url, "_blank");
                    $("#uploadModal").modal('hide');
                },
                error: function () {
                    alert("Có lỗi xảy ra!");
                },
            });
        };
        reader.readAsText(file);
    });
    });
</script>
