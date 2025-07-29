<form action="{{ route('admin.main-slider.feat-save', $item->id) }}"
      onsubmit="featDataSave(this, event)" style="width:600px;">
{{--    {!! Form::groupText('title', $item->title, 'Заголовок') !!}--}}
    {!! Form::groupText('text', $item->text, 'Текст') !!}
    <button class="btn btn-primary" type="submit">Сохранить</button>
</form>
