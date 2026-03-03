Custom Metaboxes
===

Use the `metaboxes.ini` to add your metaboxes in wordpress admin panel

---
### Title
Title of the metabox you will see in the admin panel.
###### ! - Use unique name for your metabox. If two metaboxes have the same name will show the last one in the `metaboxes.ini`
```
[Metabox title]
```
*Result:*
screenshot

---
### Post type
Post type needs to be in an array.\
You can use one metabox for different post types.
```
[Metabox title]
post_type[] = page
post_type[] = post
post_type[] = cutsom_post_type
```
*Explanation:\
`page`, `post` and `cutsom_post_type` posts will have one metabox with the title: "Metabox title"*

---
### Post id
Use `post_id` if you need display the metabox only for a single post
###### ! Not allowed to use multiple ids. You can use only one id. 
```
[Metabox title]
post_type[] = page
post_id = 100
```
*Explanation:\
Only page with post_id=100 will have the metabox `metabox title`*

---
### Fields
Use fields as an array of the metabox.\
Allowed field props you can use:
- **name*** - field name uses to save field value to DB.\
Don't use any spaces, special characters for the field name. Only letters, numbers, `-` and `_`.
- **type*** - `text || number || password || email || textarea || select || checkbox || radio || image || document || video || order || repeater`
- **title** - field name describes the field.\
Displayed above the field in bold font.
- **description** - additional instruction about the field.\
Displayed below the field title in regular font
- **options[]** - use for `select`, `radio`or`checkbox` to add options
- **post_type** - use for `select`, `radio` and `checkbox` to add options from post type
- **in_col** - use for `repeater` type to displaying sub fields in a col. Default is in a row
- **return_obj** - use for `image` type to write image data in DB as a json object. Default is an image id
- **sub_fields** - use for the `repeater` field to add your fields for the repeater
- **relation_field_name** - use for `order` field to set a relation between the posts

###### * - required props for correct work
###### ! - If you use some special characters in your title or description you will need to write those props between `'` or `"`

#### field - text
```
[Metabox title]
post_type[] = page
    fields.1.name = field_name
    fields.1.type = text
    fields.1.title = field title
    fields.1.description = field description
```
*Explanation:\
The metabox `Metabox title` will show on all `page` posts. The metabox will have one field\
`<input name='field_name' type='text'>` with title and description above the field*
###### Tabulation in the example below makes code more readable. You can write the code your own way:)

#### field - image
```
[Metabox title]
post_type[] = page
    fields.1.name = field_image
    fields.1.type = image
    fields.1.return_obj = true
```
*Return:\
`<input name="field_image" type="image">`\
for all `page` posts*