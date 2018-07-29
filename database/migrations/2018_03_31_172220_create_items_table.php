<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->string('nombre', 255);
            $table->mediumText('descripcion')->nullable();
            $table->timestamps();
        });

         DB::table('items')->insert([ 'nombre' => 'Cultura organizacional', 'categoria_id' => 1, 'descripcion' => 'Confianza y Respeto / Vivencia de calidad humana / Identificación con la organización / Valores compartidos dentro de la organización']);
         DB::table('items')->insert([ 'nombre' => 'Inducción al trabajo ', 'categoria_id' => 1, 'descripcion' => 'Preparación a las funciones del cargo / Adaptación y Dominio del cargo / Acompañamiento laboral']);         
         DB::table('items')->insert([ 'nombre' => 'Relación entre compañeros ', 'categoria_id' => 1, 'descripcion' => 'Trabajo colaborativo / Integridad / Competitividad / Relaciones interpersonales / Compañerismo']);
         DB::table('items')->insert([ 'nombre' => 'Relación con el jefe inmediato', 'categoria_id' => 1, 'descripcion' => 'Metas demandantes y alcanzables / Comunicación asertiva / Disposición de escucha y conciliación / Trato interpersonal / Apoyo y Reconocimiento por desempeño / Liderazgo']);
         DB::table('items')->insert([ 'nombre' => 'Comunicación', 'categoria_id' => 1, 'descripcion' => 'Accesibilidad de Información / Flujo de información / Clara organización y planificación de objetivos / Transparencia']);
         DB::table('items')->insert([ 'nombre' => 'Trato equitativo', 'categoria_id' => 1, 'descripcion' => 'Igualdad de derechos, géneros y edades / Oportunidades equitativas de ascenso / Coherencia salarial conforme al cargo']);


         DB::table('items')->insert([ 'nombre' => 'Carga laboral', 'categoria_id' => 2, 'descripcion' => 'Nivel de carga laboral / Exigencia del supervisor']);
         DB::table('items')->insert([ 'nombre' => 'Tareas', 'categoria_id' => 2, 'descripcion' => 'Tareas diversas, amenas e interesantes / Diversidad en el contenido de las tareas y con los contactos sociales / Claridad de las tareas / Satisfacción con las tareas / Tareas que conllevan responsabilidad']);
         DB::table('items')->insert([ 'nombre' => 'Equilibrio trabajo-vida', 'categoria_id' => 2, 'descripcion' => 'Equilibrio entre carga laboral y tiempo libre / Cumplimiento de horas establecidas por el contrato / Respeto por el espacio y la vida personal / Vacaciones y Descansos / Hora extras']);
         DB::table('items')->insert([ 'nombre' => 'Condiciones del puesto de trabajo', 'categoria_id' => 2, 'descripcion' => 'Seguridad laboral / Condiciones de trabajo adecuadas / Calidad de los equipos de trabajo / Zonas de recreación y descanso / Grado de riesgos']);
         DB::table('items')->insert([ 'nombre' => 'Responsabilidad social', 'categoria_id' => 2, 'descripcion' => 'Consciencia ambiental y social de la empresa']);

         DB::table('items')->insert([ 'nombre' => 'Remuneración', 'categoria_id' => 3, 'descripcion' => 'Remuneración corresponde a responsabilidad y esfuerzo / Retribución satisfactoria / Pago puntual / Beneficios extralegales / Periodo de pago / Pago de horas extras']);
         DB::table('items')->insert([ 'nombre' => 'Estabilidad laboral', 'categoria_id' => 3, 'descripcion' => 'Tipo de contrato/ Cambio de personal']);
         DB::table('items')->insert([ 'nombre' => 'Oportunidades de ascenso', 'categoria_id' => 3, 'descripcion' => 'Posibilidad de ascenso / Transparencia de condiciones para ascender / Visualización de oportunidades a futuro']);
         DB::table('items')->insert([ 'nombre' => 'Crecimiento profesional', 'categoria_id' => 3, 'descripcion' => 'Crecimiento personal / Entorno potencial para el uso y desarrollo de competencias y conocimiento / Adquisición de conocimiento específico del sector/ámbito']);


         DB::table('items')->insert([ 'nombre' => 'Cultura organizacional', 'categoria_id' => 4, 'descripcion' => 'Confianza y Respeto / Vivencia de calidad humana / Identificación con la organización / Valores compartidos dentro de la organización']);
         DB::table('items')->insert([ 'nombre' => 'Relación entre compañeros', 'categoria_id' => 4, 'descripcion' => 'Relaciones interpersonales / Trabajo colaborativo / Asistencia / Compañerismo / Receptividad de los compañeros / Integración al equipo']);
         DB::table('items')->insert([ 'nombre' => 'Inducción y preparación laboral', 'categoria_id' => 4, 'descripcion' => 'Reconocimiento de la estrategia organizacional / Preparación a las funciones del cargo/tareas de la práctica / Acompañamiento y Retroalimentación']);
         DB::table('items')->insert([ 'nombre' => 'Relación con el jefe inmediato ', 'categoria_id' => 4, 'descripcion' => 'Trato interpersonal / Comunicación asertiva / Consideración de desempeño / Valoración de opinión personal / Interés y Atención / Liderazgo']);
         DB::table('items')->insert([ 'nombre' => 'Reconocimiento', 'categoria_id' => 4, 'descripcion' => 'Reconocimiento personal / Reconocimiento laboral / Parte del equipo / Participación']);

         DB::table('items')->insert([ 'nombre' => 'Tareas', 'categoria_id' => 5, 'descripcion' => 'Planificación y Dirección / Tareas diversas, amenas e interesantes / Claridad de las tareas / Satisfacción con las tareas / Rareas acorde al área de estudio / Promoción de crecimiento laboral']);
         DB::table('items')->insert([ 'nombre' => 'Responsabilidad', 'categoria_id' => 5, 'descripcion' => 'Autonomía / Proyectos propios / Objetivos asignados para la práctica']);
         DB::table('items')->insert([ 'nombre' => 'Carga laboral', 'categoria_id' => 5, 'descripcion' => 'Nivel de carga laboral acorde al horario / Exigencia del supervisor']);
         DB::table('items')->insert([ 'nombre' => 'Condiciones del lugar de trabajo', 'categoria_id' => 5, 'descripcion' => 'Seguridad laboral / Condiciones de trabajo adecuadas / Calidad de los equipos de trabajo / Zonas de recreación y descanso / Grado de riesgos']);

         DB::table('items')->insert([ 'nombre' => 'Crecimiento laboral', 'categoria_id' => 6, 'descripcion' => 'Desarrollo de habilidades laborales / Profundización de conocimientos del área de estudio / Adquisición de conocimiento específico del sector/ámbito / Promoción del crecimiento laboral']);
         DB::table('items')->insert([ 'nombre' => 'Crecimiento personal', 'categoria_id' => 6, 'descripcion' => 'Desarrollo de habilidades personales y sociales / Oportunidad de establecer contactos / Calidad de referencias de parte de la empresa / Promoción del crecimiento personal']);
         DB::table('items')->insert([ 'nombre' => 'Remuneración', 'categoria_id' => 6, 'descripcion' => 'Remuneración satisfactoria / Pago puntual / Beneficios extralegales / Pago de horas extras']);
         DB::table('items')->insert([ 'nombre' => 'Tiempo laboral', 'categoria_id' => 6, 'descripcion' => 'Cumplimiento de horas establecidas por el contrato / Respeto por el espacio y la vida personal / Vacaciones y Descansos / Horas extra']);
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
