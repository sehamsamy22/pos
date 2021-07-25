<div class=" form-group col-sm-12 col-xs-12 pull-left">
    <div class="form-group form-float">
        <label class="form-label">   التصنيف الفرعى</label>
        <div class="form-line">
            {!! Form::select("sub_category_id",$subcategories,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر التصنيف الفرعى '])!!}
        </div>
    </div>
</div>
