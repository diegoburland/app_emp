<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
          $table->increments('id');

          $table->string('nur', 20)->nullable();
          $table->string('camara', 200)->nullable();
          $table->string('tipo_iden', 20)->nullable();
          $table->string('nit', 30)->nullable();
          $table->string('razon_social', 300);  
          $table->string('org_juridica', 100)->nullable();
          $table->string('categoria', 30)->nullable();
          $table->string('estado', 30)->nullable();
          $table->date('fecha_con')->nullable();
          $table->date('fecha_mat')->nullable();
          $table->date('fecha_ult')->nullable();
          $table->string('ult_ano', 10)->nullable();
          $table->string('direccion', 200)->nullable();
          $table->string('ciudad', 200)->nullable();
          $table->string('postal', 20)->nullable();
          $table->string('barrio', 300)->nullable();
          $table->string('localidad', 300)->nullable();
          $table->string('imp_exp', 50)->nullable();
          $table->string('tel1', 20)->nullable();
          $table->string('tel2', 20)->nullable();
          $table->string('tel3', 20)->nullable();
          $table->string('fax', 20)->nullable();
          $table->string('cel', 20)->nullable();
          $table->string('email', 255)->nullable();
          $table->string('pagina_w', 20)->nullable();
          $table->string('ciiu', 20)->nullable();
          $table->string('ciiu_des', 300)->nullable();

          $table->string('sector_economico', 300);

          $table->string('tipo_id_repre', 20)->nullable();
          $table->string('id_repre', 20)->nullable();
          $table->string('repre_nombre', 20)->nullable();
          $table->string('personal', 20)->nullable();
          $table->string('clasificacion', 20)->nullable();
          $table->string('activo_total', 50)->nullable();
          $table->string('activo_sin_ajuste', 50)->nullable();
          $table->string('activo_corriente', 50)->nullable();
          $table->string('activo_fijo', 50)->nullable();
          $table->string('valoracion', 50)->nullable();
          $table->string('otro_activo', 50)->nullable();
          $table->string('pasivo_corriente', 50)->nullable();
          $table->string('oblicacion_largo', 50)->nullable();
          $table->string('pasivo_total', 50)->nullable();
          $table->string('patrimonio', 50)->nullable();
          $table->string('paspat', 50)->nullable();
          $table->string('ventas', 50)->nullable();
          $table->string('costo', 50)->nullable();
          $table->string('util_oper', 50)->nullable();
          $table->string('util_neta', 50)->nullable();
          $table->string('gastos', 50)->nullable();


          $table->string('nombres_contacto', 50)->nullable();
          $table->string('apellidos_contacto', 100)->nullable();
          $table->string('tel_contacto', 15)->nullable();
          $table->string('cel_contacto', 15)->nullable();
          $table->string('email_contacto', 255)->nullable();

          $table->string('verificada', 30)->nullable();

          $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
