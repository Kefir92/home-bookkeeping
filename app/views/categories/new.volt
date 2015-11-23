{{content()}}
{{ link_to('categories/index', '<i class="glyphicon glyphicon-chevron-left"></i> К списку разделов', 'class': 'btn btn-back btn-default') }}
{{ form('categories/new', 'role': 'form') }}
    <fieldset>
        <?/*<div class="form-group">
            {{ form.label('parentID') }}
            {{ form.render('parentID', ['class': 'form-control']) }}
        </div>*/?>
        <div class="form-group">
            {{ form.label('title') }}
            {{ form.render('title', ['class': 'form-control']) }}
        </div>
        <div class="form-group">
            {{ submit_button('Отправить', 'class': 'btn btn-primary btn-large') }}
        </div>
    </fieldset>
</form>