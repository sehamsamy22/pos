@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="form-group col-sm-6 col-xs-12 pull-left">
	<label>تاريخ العملية </label>
	{!! Form::date("date",null,['class'=>'form-control'])!!}
</div>

<input type="hidden" name="type" value="يدوى">
<input type="hidden" name="source" value=" قيديدوى">


<div class="form-group col-sm-6 col-xs-12 pull-left">
	<label> البيان العام </label>
	{!! Form::text("details",null,['class'=>'form-control','placeholder'=>' التفاصيل '])!!}
</div>

<table id="qyoud-table">
	<thead>
		<tr class="thead_entry " style="    background: #ccc; ">
			<th> رقم الحركة </th>
			<th> مدين </th>
			<th> دائن </th>
			<th> الحساب </th>
			<th> الوصف </th>
			<th> حذف </th>
		</tr>
	</thead>
	<tbody id="qyoud-table-tbody">
        @if(isset($entry))
            @foreach($entry->accounts()->get() as $key=>$accountEntry)
        <tr class="single-row">
			<td>{{++$key}}</td>


			<td>
				<input type="number" min="0" name="debtor[]" class="form-control debtor" @if($accountEntry->affect=='debtor')value= "{{$accountEntry->amount}}" @else value="0" @endif>
			</td>
			<td>
				<input type="number" min="0" name="creditor[]" class="form-control creditor" @if($accountEntry->affect=='creditor')value= "{{$accountEntry->amount}}" @else value="0" @endif>
			</td>

			<td>
				<select name="account_id[]" class="form-control js-example-basic-single">
                    @foreach ($accounts as $account)
                    @if($accountEntry->account_id==$account->id)
					<option value={{$account->id}}    selected >{{$account->name}} -{{$account->code}}</option>
                    @else
                    <option value={{$account->id}}     >{{$account->name}} -{{$account->code}}</option>
                     @endif
                    @endforeach
				</select>
			</td>
			<td>
				<input type="text" name="notes[]" class="form-control">
            </td>

			<td>
            <a href="{{route("accounting.entries.destroy_account",['id'=>$accountEntry->id])}}" data-toggle="tooltip" class="btn btn-danger">X</a>
                {{-- {!!Form::open( ['route' => ['accounting.entries.destroy_account',$accountEntry->id] ,'id'=>'delete-form'.$accountEntry->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!} --}}
            </td>
        </tr>
        @endforeach
        @else
		<tr class="single-row">
			<td>1</td>

			<td>
				<input type="number" min="0" name="debtor[]" class="form-control debtor" value="0">
			</td>
			<td>
				<input type="number" min="0" name="creditor[]" class="form-control creditor" value="0">
			</td>
			<td>
				<select name="account_id[]" class="form-control js-example-basic-single" >
					@foreach ($accounts as $account)
					<option value={{$account->id}}>{{$account->name}} -{{$account->code}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<input type="text" name="notes[]" class="form-control">
			</td>
			<td>

            </td>
        </tr>
        @endif
	</tbody>
	<tfoot>
			<td>
				<button type="button" class="btn btn-success" id="add-new">إضافة حساب اخر <i class="icon-arrow-left13 position-right"></i></button>
			</td>
			<td>
				<input type="number" min="0" name="debtor_total" class="form-control" id="debtor" readonly>
			</td>
			<td>
				<input type="number" min="0" name="creditor_total"  class="form-control" id="creditor" readonly>
			</td>
			<td>

			</td>


			<td>

			</td>

	</tfoot>
</table>

<div class="text-center col-md-12">
	<div class="text-right">
		<button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>

	</div>
</div>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();

	});

	$("#from_account_id").on('change', function() {
		var id = $(this).val();
		console.log(id);
		$('.toAccounts').empty();
		$.ajax({
			url: "/dashboard/entries/toAccounts/" + id,
			type: "get",
			data: {
				'ids': id,
			}

		}).done(function(data) {
			$('.perent_account_form').html(data.perent);
			$('.toAccounts').html(data.data);
		}).fail(function(error) {
			console.log(error);
		});
	})
</script>
<script>
	$(document).ready(function(){
		$("#add-new").on('click' , function(){
			var num = $("#qyoud-table-tbody tr").length + 1;
			$("#qyoud-table-tbody").append(`<tr class="single-row">
			<td>${num}</td>

			<td>
				<input type="number" min="0" name="debtor[]" class="form-control debtor" value="0">
			</td>
			<td>
				<input type="number" min="0" name="creditor[]" class="form-control creditor" value="0">
			</td>
			<td>
				<select name="account_id[]" class="form-control select">
					@foreach ($accounts as $account)
					<option value={{$account->id}}>{{$account->name}} -{{$account->code}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<input type="text" name="notes" class="form-control">
			</td>
			<td>
				<a href="#" class="btn btn-danger">X</a>
			</td>
		</tr>`);

		AfterLookUpLoad();

			calc();
			function AfterLookUpLoad() {

				$(".select").select2({
					placeholder: "Select Type(Screen)",
					allowClear: true

				});
			};
			$('.creditor').change(function(){
				$(this).parents('tr').find('.debtor').val('0');
				calc()
			});
			$('.debtor').change(function(){
				$(this).parents('tr').find('.creditor').val('0');
				calc()
			});
			$(".delete-it").on('click' , function(){
				$(this).parents('tr').remove();
				calc()
			})
			function calc(){
				var allCredits = 0;
				var allDebts = 0;
				$('.creditor').each(function(){
					allCredits = allCredits + Number($(this).val());
					$("#creditor").val(allCredits);
				});
				$('.debtor').each(function(){
					allDebts = allDebts + Number($(this).val());
					$("#debtor").val(allDebts);
				})
			}
		})

		$("#entries-forma").submit(function(){

			var creditor = Number($("#creditor").val());
			var debtor = Number($("#debtor").val());
			if(creditor !== debtor){
                swal("   ", " الطرف المدين لا يساوى الطرف الدائن", 'danger', {
                    buttons: 'موافق'
                });
				return false
			}
		})


	})
</script>
<script>
    function Delete(id) {
        var item_id=id;
        console.log(item_id);
        swal({
            title: "هل أنت متأكد ",
            text: "هل تريد حذف هذا الحساب م القيد ؟",
            icon: "warning",
            buttons: ["الغاء", "موافق"],
            dangerMode: true,

        }).then(function(isConfirm){
            if(isConfirm){
                document.getElementById('delete-form'+item_id).submit();
            }
            else{
                swal("تم االإلفاء", "حذف  الحساب  تم الغاؤه",'info',{buttons:'موافق'});
            }
        });
    }
</script>
@endsection
