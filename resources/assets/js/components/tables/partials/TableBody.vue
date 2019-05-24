<template>
    <tbody>
        <slot>
            <tr>
                <td 
                    class="text-muted text-center" 
                    :colspan="columns">
                    {{ this.noDataToDisplay || 'No data to display' }}
                </td>
            </tr>
        </slot>
    </tbody>
</template>

<script>
    export default {
        props: [
            'data',
            'columns',
            'noDataToDisplay' || 'No data to display',
        ],
    }
</script>
