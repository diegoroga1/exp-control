<template>
		<div class="card shadow mb-4">
				<div v-show="show_header" class="card-header py-3 bg-dark">
						<h6  class="m-0 font-weight-bold">
								<slot name="titleCard"></slot>
						</h6>
				</div>
				<div :class="`card-body ${padding}`">
						<slot></slot>
				</div>
		</div>
</template>
<script>
export default {
		name: "CardComponent",
		props: {
				'padding': {default: 'p-4'},
				'show_header': {default: true}
		}
}
</script>
