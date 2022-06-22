@extends('layouts.custom')

@section('content')
    <section id="admin_manage" class="top">
        <div class="header">
            <div class="navbar">
                <h1>
                    <a href=""><img src="{{ asset('img/admin-logo.svg') }}" alt=""><span>管理画面</span></a>
                </h1>
            </div>
            <div class="menubar">
                <div class="menubar-group">
                    <a href="" class="menubar-name" id="admin_save">
                        保存
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <form method="POST" enctype="multipart/form-data" id="managePost">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table>
                    <tbody>
                        <tr>
                            <th>
                                会社名
                            </th>
                            <th>
                                担当者名
                            </th>
                            <th>
                                メールアドレス
                            </th>
                            <th>
                                提携契約書
                            </th>
                            <th>
                                プレスリリースURL
                            </th>
                            <th>
                                ステータス
                            </th>
                        </tr>
                        @forelse($users as $user)
                            <input type="hidden" name="id[]" value="{{$user->id}}">	
                            <tr>
                                <td>
                                    <input type="text" name="company_{{$user->id}}" value="{{ $user->company }}" class="non-editable" readonly="readonly">
                                </td>
                                <td>
                                    <input type="text" name="person_{{$user->id}}" value="{{ $user->person }}" class="non-editable" readonly="readonly">
                                </td>
                                <td>
                                    <input type="text" name="email_{{$user->id}}" value="{{ $user->email }}" class="non-editable" readonly="readonly">
                                </td>
                                <td>
                                    <div>
                                        <label class="" for="chooseFile_{{$user->id}}">アップロード</label>
                                        <input type="file" id="chooseFile_{{$user->id}}" name="doc_{{$user->id}}" value="{{ $user->doc }}" style="display: none">
                                        <input type="text" name="fileName_{{$user->id}}" id="fileName_{{$user->id}}" readonly="readonly" class="filename non-editable">
                                        <script>
                                            $('#chooseFile_{{$user->id}}').change(function() {
                                                console.log($('#chooseFile_{{$user->id}}')[0].files[0].name);
                                                var pngFile = $('#chooseFile_{{$user->id}}')[0].files[0].name;
                                                $('#fileName_{{$user->id}}').val(pngFile);
                                            });
                                            $("#fileName_{{$user->id}}").val("{{ $user->doc }}");
                                        </script>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="release_url_{{$user->id}}" value="{{ $user->release_url }}">
                                </td>
                                <td>
                                    <select name="status_{{$user->id}}" id="status_{{$user->id}}">
                                        <option value=""></option>
                                        <option value="登録後表示">登録後表示</option>
                                        <option value="契約書締結中">契約書締結中</option>
                                        <option value="契約書締結済">契約書締結済</option>
                                        <option value="特典内容確定済">特典内容確定済</option>
                                        <option value="希望日決定済">希望日決定済</option>
                                        <option value="送信後原稿チェック中">送信後原稿チェック中</option>
                                        <option value="原稿確定済（全て完了）">原稿確定済<br>（全て完了）</option>
                                    </select>
                                    <script>
                                        $("#status_{{$user->id}} option[value={{ $user->status }}]").attr('selected','selected');
                                    </script>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>  
                        @endforelse
                    </tbody>
                </table>
            </form>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
    </section>
    <script>
        $("#admin_save").click(function(e) {
            e.preventDefault();
            var form = $('#managePost')[0];
            var formData = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('adminManagePost') }}",
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    window.location.href = "{{ route('adminManage') }}";
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
    </script>
@stop