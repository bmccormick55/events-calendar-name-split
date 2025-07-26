<?php
/**
 * Modal: Attendee Registration.
 * This is a direct override of the plugin file for custom fields.
 */

$non_meta_count = 0;
$classes = [
    'tribe-tickets__attendee-tickets-form',
    sanitize_html_class($provider_class),
    'tribe-validation',
];
?>
<div class="tribe-tickets__attendee-tickets">
    <?php $this->template('v2/modal/attendee-registration/title'); ?>
    <?php $this->template('v2/modal/attendee-registration/notice/error'); ?>

    <form
        id="tribe-modal__attendee-registration"
        <?php tribe_classes($classes); ?>
        method="post"
        name="event<?php echo esc_attr($post_id); ?>"
        autocomplete="off"
        novalidate
    >
        <?php foreach ($tickets as $ticket) : ?>
            <?php
            if (!$ticket->has_meta_enabled()) {
                $non_meta_count++;
                continue;
            }
            $ticket_id = $ticket->ID;
            ?>
            <div class="tribe-tickets__attendee-tickets-container" data-ticket-id="<?php echo esc_attr($ticket_id); ?>">
                <h3 class="tribe-common-h5 tribe-common-h5--min-medium tribe-common-h--alt tribe-ticket__tickets-heading">
                    <?php echo esc_html(get_the_title($ticket_id)); ?>
                </h3>

                <!-- BEGIN Replace Name field with First/Last -->
                <div class="tribe-tickets__form-field tribe-tickets__form-field--attendee_first_name">
                    <label for="attendee_first_name_<?php echo esc_attr($ticket_id); ?>">First Name <span class="required">*</span></label>
                    <input type="text" name="attendee_first_name[<?php echo esc_attr($ticket_id); ?>][]" id="attendee_first_name_<?php echo esc_attr($ticket_id); ?>" value="" required>
                </div>
                <div class="tribe-tickets__form-field tribe-tickets__form-field--attendee_last_name">
                    <label for="attendee_last_name_<?php echo esc_attr($ticket_id); ?>">Last Name <span class="required">*</span></label>
                    <input type="text" name="attendee_last_name[<?php echo esc_attr($ticket_id); ?>][]" id="attendee_last_name_<?php echo esc_attr($ticket_id); ?>" value="" required>
                </div>
                <!-- END Replace Name field with First/Last -->

                <!-- Render all meta fields, including hidden name field -->
                <?php $this->template('v2/modal/attendee-registration/fields', ['ticket' => $ticket]); ?>
            </div>
        <?php endforeach; ?>

        <?php $this->template('v2/modal/attendee-registration/notice/non-ar', ['non_meta_count' => $non_meta_count]); ?>

        <input type="hidden" name="tribe_tickets_saving_attendees" value="1" />
        <input type="hidden" name="tribe_tickets_ar" value="1" />
        <input type="hidden" name="tribe_tickets_ar_data" value="" id="tribe_tickets_ar_data" />

        <?php $this->template('v2/modal/attendee-registration/footer'); ?>

    </form>
</div>

<!-- Hide original name field, if present in meta -->
<style>
.tribe-tickets__registration-forms label[for*="attendee_name"],
.tribe-tickets__registration-forms input[name^="attendee_name"],
.tribe-tickets__form-field--attendee_name {
    display: none !important;
}
</style>

<!-- JS to fill hidden name field -->
<script>
document.addEventListener('input', function() {
    var containers = document.querySelectorAll('.tribe-tickets__attendee-tickets-container');
    containers.forEach(function(container) {
        var first = container.querySelector('input[name^="attendee_first_name"]');
        var last = container.querySelector('input[name^="attendee_last_name"]');
        var name = container.querySelector('input[name^="attendee_name"]');
        if (first && last && name) {
            name.value = (first.value + ' ' + last.value).trim();
        }
    });
});
</script>
