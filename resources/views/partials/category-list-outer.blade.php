<select name="parent_id" style="width: 100%">
    <option value=null>ROOT</option>
    @each('partials.category-list-inner', $categories, 'category')
</select>