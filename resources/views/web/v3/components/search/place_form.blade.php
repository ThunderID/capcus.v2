{!! Form::open(['method' => 'GET']) !!}
	<div class="form-group">
		<div class="form-elements">
			<label>Tujuan Wisata</label>
			<div class="form-item">
				<i class="awe-icon awe-icon-marker-1"></i>
				{!! Form::select('', $place_list, '', ['class' => 'selectize']) !!}
			</div>
		</div>
	</div>
	<div class="form-actions">
		<input type="submit" value="Cari">
	</div>

</form>