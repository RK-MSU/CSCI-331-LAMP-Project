<div class="row">
    <div class="col-12">
        <?php 
        foreach($settings as $fieldset) {
            echo lamp('View', '_shared/form/fieldset')->render([
                'settings' => $fieldset
            ]);
        }
        ?>
    </div>
</div>