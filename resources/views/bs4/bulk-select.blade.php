<input class="form-check-input"
       type="checkbox"
       name='bulkSelected[]'
       value="{{ $key }}"
       wire:model{{ $live ? '.live' : '' }}='bulkSelected'>
