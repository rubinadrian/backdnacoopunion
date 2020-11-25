<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnsProductosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('productos', function (Blueprint $table) {
			$table->renameColumn('pdf', 'file_senasa');
			$table->string('file_espe', 100)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('productos', function (Blueprint $table) {
			$table->renameColumn('file_senasa', 'pdf');
			$table->dropColumn(['file_espe']);
		});
	}
}
