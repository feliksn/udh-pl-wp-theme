/* eslint-disable prefer-arrow-callback */
/* eslint-disable no-undef */
/* eslint-disable func-names */

const mediaModalTitle = 'Dodaj plik';
const mediaModalButtonText = 'Wybierz plik';
const metaboxImageHTML = '<img class="metabox-image">';
const metaboxFileHTML = `
    <div class="metabox-file">
        <span class="metabox-file-icon dashicons"></span><br>
        <span class="metabox-file-name">
            Nazwa: <strong><?php echo $file_name; ?></strong>
        </span><br>
        <span class="metabox-file-type">
            Typ: <strong><?php echo $file_type; ?></strong>
        </span>
    </div>`;
const metaboxThumbnailSizeName = 'thumbnail';

jQuery(($) => {
    // ----- MEDIA BUTTON UPLOAD -----
    $('body').on('click', '.metabox-button-upload', function (event) {
        event.preventDefault();
        const button = $(this);
        const fieldType = button.data('field-type');
        const libraryType = fieldType === 'document' ? 'application' : fieldType;
        const imageId = button.next().next().val();
        const customUploader = wp.media({
            // ??? Filter file types in the modal
            // Modal window title
            title: mediaModalTitle,
            // Modal window button
            button: {
                text: mediaModalButtonText,
            },
            // Allow multiple selecting
            multiple: false,
            library: { type: libraryType },
        }).on('select', () => { // it also has "open" and "close" events
            const attachment = customUploader.state().get('selection').first().toJSON();
            console.log(attachment);
            if (attachment.type === 'image') {
                const attachmentUrl = attachment.sizes[metaboxThumbnailSizeName]
                    ? attachment.sizes[metaboxThumbnailSizeName].url
                    : attachment.sizes.full.url;
                button
                    .html(metaboxImageHTML)
                    .children()
                    .attr('src', attachmentUrl);
            } else {
                button.html(metaboxFileHTML);
                button.find('.metabox-file-icon').addClass('dashicons-media-'.fieldType);
                button.find('.metabox-file-name strong').text(attachment.name);
                button.find('.metabox-file-type strong').text(`${attachment.type}/${attachment.subtype}`);
            }
            // add image instead the button text
            button.removeClass('button');
            // show link to remove the image
            button.next().show();
            // Write image id to the hidden input
            button.next().next().val(attachment.id);
        });

        // already selected images
        customUploader.on('open', () => {
            if (imageId) {
                const selection = customUploader.state().get('selection');
                const attachment = wp.media.attachment(imageId);
                attachment.fetch();
                selection.add(attachment ? [attachment] : []);
            }
        });
        customUploader.open();
    });

    // ----- MEDIA BUTTON REMOVE -----
    $('body').on('click', '.metabox-button-remove', function (event) {
        event.preventDefault();
        const button = $(this);
        // clean the hidden field value
        button.next().val('');
        // replace the image with text
        button.hide().prev().addClass('button').html(mediaModalButtonText);
    });

    // ------ CHECKBOX -----
    $('body').on('click', '.metabox-field[type="checkbox"]', function () {
        const checkbox = $(this);
        if (checkbox.attr('checked')) checkbox.attr('checked', false);
        else checkbox.attr('checked', true);
        // Scroll counter
        let scrollCounter = 0;
        $('.metabox-field-scroll-box')
            .find('.metabox-field')
            .each(function (i, e) {
                if ($(e).attr('checked')) scrollCounter += 1;
            });
        $('.metabox-field-scroll-counter')
            .find('span')
            .text(scrollCounter);
    });

    // ----- SCROLL BOX -----
    // up
    const scrollBox = $('.metabox-field-scroll-box');
    const scrollBoxDelay = 200;
    $('body').on('click', '#metabox-field-scroll-up', function (e) {
        e.preventDefault();
        scrollBox.animate({ scrollTop: scrollBox.scrollTop() - 200 }, scrollBoxDelay);
    });
    // down
    $('body').on('click', '#metabox-field-scroll-down', function (e) {
        e.preventDefault();
        scrollBox.animate({ scrollTop: scrollBox.scrollTop() + 200 }, scrollBoxDelay);
    });

    // ----- ADD REPEATER ROW -----
    $('body').on('click', '.metabox-repeater-button-add', function (event) {
        // Disable default button action
        event.preventDefault();

        // tbody element where we will add new rows
        const tbody = $(this)
            .parent()
            .siblings('.metabox-repeater-table')
            .find('.metabox-repeater-tbody');

        // A template row to create new rows in the table
        const row = tbody
            .find('.metabox-repeater-row-template')
            .clone()
            .removeClass('metabox-repeater-row-template')
            .addClass('metabox-repeater-row');

        let rowIndex = tbody
            .find('.metabox-repeater-row')
            .last()
            // if tbody doesn't have any .metabox-repeater-row  .index() = -1
            .index();
        rowIndex = rowIndex === -1 ? 1 : rowIndex + 1;

        // First cell in the row is rowIndex - rows order
        row.find('.metabox-repeater-cell').eq(0).text(rowIndex);

        // Append the row with changed data to the tbody element
        row.appendTo(tbody);
    });

    // ----- DELETE REPEATER ROW -----
    $('body').on('click', '.metabox-repeater-button-delete', function (event) {
        event.preventDefault();
        const button = $(this);

        // Before the deleting get all siblings rows
        const rows = button
            .parents('.metabox-repeater-row')
            .siblings('.metabox-repeater-row');

        // Delete a row with the button
        button.parents('.metabox-repeater-row').remove();

        // Update a row index for the rest rows
        rows.each((i, e) => {
            $(e)
                .find('.metabox-repeater-cell')
                .eq(0)
                .text(i + 1);
        });
    });

    // ----- SORT REPEATER ROWS -----
    $('.metabox-repeater-tbody').sortable({
        tolerance: 'pointer',

        // Change a cursor shape to move shape during the sorting
        cursor: 'move',

        // Sort only visible rows (not a template row)
        items: '> .metabox-repeater-row',

        // Highlight sortable rows in the repeater table
        // classes: { 'ui-sortable': 'highlight' },

        // Callback function when the sorting is complete
        stop(event, ui) {
            // Get every repeater rows in the const
            const rows = ui
                .item
                .parent()
                .children('.metabox-repeater-row');

            // Change the row index after the sorting is complete
            rows.each((i, e) => {
                $(e)
                    .find('.metabox-repeater-cell')
                    .eq(0)
                    .text(i + 1);
            });
        },
    });

    // ----- SORT FIELD -----
    $('.metabox-order-list').sortable({
        tolerance: 'pointer',

        // Change a cursor shape to move shape during the sorting
        cursor: 'move',

        // Highlight sortable rows in the repeater table
        // classes: { 'ui-sortable': 'highlight' },
    });
});
