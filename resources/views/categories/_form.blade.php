@php
    function buildTreeOptions($categories, $prefix = '') {
        $options = [];
        foreach ($categories as $cat) {
            $options[$cat->id] = $prefix . $cat->name;
            // if ($cat->children->count()) {
            //     $options += buildTreeOptions($cat->children, $prefix . $cat->name . ' > ');
            // }
        }
        return $options;
    }
@endphp

<div class="mb-3">
    <label for="name" class="form-label">Category Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" class="form-select" required>
        <option value="1" {{ old('status', $category->status ?? '') == 1 ? 'selected' : '' }}>Enabled</option>
        <option value="2" {{ old('status', $category->status ?? '') == 2 ? 'selected' : '' }}>Disabled</option>
    </select>
</div>

<div class="mb-3">
    <label for="parent_id" class="form-label">Parent Category</label>
    <select name="parent_id" class="form-select">
        <option value="">-- None --</option>
        @foreach($dropdownOptions as $id => $name)
            <option value="{{ $id }}" {{ isset($category) && $category->parent_id == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

