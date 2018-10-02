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

         DB::table('items')->insert([ 'nombre' => 'Cultura organizacional', 'categoria_id' => 1, 'descripcion' => 'Confianza y Respeto / Normas, valores y creencias compartidos dentro de la organización / Cultura compartida/ Ética / Vivencia de calidad humana']);
         DB::table('items')->insert([ 'nombre' => 'Sentido de Pertenencia', 'categoria_id' => 1, 'descripcion' => 'Identificación con la organización / Orgullo de trabajar en la organización/ Participación']);
         DB::table('items')->insert([ 'nombre' => 'Reconocimiento ', 'categoria_id' => 1, 'descripcion' => 'Reconocimiento personal y laboral ']);
         DB::table('items')->insert([ 'nombre' => 'Relación entre compañeros ', 'categoria_id' => 1, 'descripcion' => 'Trabajo en equipo / Integridad / Competitividad / Relaciones interpersonales / Compañerismo']);
         DB::table('items')->insert([ 'nombre' => 'Liderazgo', 'categoria_id' => 1, 'descripcion' => 'Relación con Jefe inmediato / Capacidad de liderar y motivar / Metas retadoras alcanzables / Comunicación asertiva / Disposición de escucha y conciliación / Trato interpersonal/ Retroalimentación']);
         DB::table('items')->insert([ 'nombre' => 'Comunicación', 'categoria_id' => 1, 'descripcion' => 'Accesibilidad y flujo de información / Misión y visión clara / Clara organización y planificación de objetivos / Transparencia/ Información sobre metas, desafíos y logros de la organización/ Reuniones recurrentes']);
         DB::table('items')->insert([ 'nombre' => 'Confianza', 'categoria_id' => 1, 'descripcion' => 'Respeto y confianza existente entre colaboradores y líderes/ Posibilidad de asumir responsabilidad y tomar decisiones / Cultura de control o de confianza ']);
         DB::table('items')->insert([ 'nombre' => 'Trato equitativo', 'categoria_id' => 1, 'descripcion' => 'Igualdad de derechos, géneros y edades / Oportunidades equitativas de ascenso / Coherencia salarial conforme al cargo/ Equidad en la remuneración / Ausencia de favoritismo']);
         DB::table('items')->insert([ 'nombre' => 'Responsabilidad social y ambiental', 'categoria_id' => 1, 'descripcion' => 'Consciencia social y ambiental/ Sostenibilidad/ Compromiso social y ambiental']);         
         
         //DB::table('items')->insert([ 'nombre' => 'Relación con el jefe inmediato', 'categoria_id' => 1, 'descripcion' => 'Metas demandantes y alcanzables / Comunicación asertiva / Disposición de escucha y conciliación / Trato interpersonal / Apoyo y Reconocimiento por desempeño / Liderazgo']);                 
         DB::table('items')->insert([ 'nombre' => 'Carga laboral', 'categoria_id' => 2, 'descripcion' => 'Intensidad laboral / Exigencia del supervisor']);
         DB::table('items')->insert([ 'nombre' => 'Tareas', 'categoria_id' => 2, 'descripcion' => 'Diversidad en el contenido de las tareas/ Claridad de las tareas / Satisfacción con el desempeño de las tareas / Tareas que conllevan responsabilidad/ Monotonía']);
         DB::table('items')->insert([ 'nombre' => 'Equilibrio trabajo-vida', 'categoria_id' => 2, 'descripcion' => 'Equilibrio entre carga laboral y tiempo libre / Cumplimiento de horas establecidas por el contrato / Respeto por el espacio y la vida personal / Vacaciones y Descansos / Horas extras laboradas']);
         DB::table('items')->insert([ 'nombre' => 'Condiciones del lugar de trabajo', 'categoria_id' => 2, 'descripcion' => 'Seguridad laboral / Condiciones de trabajo adecuadas / Calidad de los equipos de trabajo / Zonas de recreación y descanso / Grado de riesgos / Ergonomía']);
         
         DB::table('items')->insert([ 'nombre' => 'Inducción al trabajo ', 'categoria_id' => 3, 'descripcion' => 'Preparación a las funciones del cargo / Adaptación al cargo / Acompañamiento laboral/ Talleres de Inducción']);                  
         DB::table('items')->insert([ 'nombre' => 'Estabilidad laboral', 'categoria_id' => 3, 'descripcion' => 'Tipo de contrato/ Cambio de personal']);
         DB::table('items')->insert([ 'nombre' => 'Oportunidades de ascenso', 'categoria_id' => 3, 'descripcion' => 'Posibilidad de ascenso / Transparencia de condiciones para ascender / Visualización de oportunidades a futuro']);
         DB::table('items')->insert([ 'nombre' => 'Crecimiento profesional', 'categoria_id' => 3, 'descripcion' => 'Se promueve el crecimiento personal y laboral / Entorno favorable para el uso y desarrollo de competencias y conocimiento / Adquisición de conocimiento específico del sector y ámbito/ Desarrollo de habilidades personales y sociales']);         
         DB::table('items')->insert([ 'nombre' => 'Remuneración', 'categoria_id' => 3, 'descripcion' => 'Remuneración corresponde a responsabilidad y esfuerzo / Retribución satisfactoria / Pago puntual / Beneficios extralegales / Periodo de pago / Pago de horas extras']);
                         
         DB::table('items')->insert([ 'nombre' => 'Cultura organizacional', 'categoria_id' => 4, 'descripcion' => 'Confianza y Respeto / Vivencia de calidad humana / Sentido de pertenencia / Valores compartidos dentro de la organización']);
         DB::table('items')->insert([ 'nombre' => 'Relación entre compañeros', 'categoria_id' => 4, 'descripcion' => 'Relaciones interpersonales / trabajo en equipo / Acompañamiento / Compañerismo / Receptividad de los compañeros / Integración al equipo']);
         DB::table('items')->insert([ 'nombre' => 'Inducción y preparación laboral', 'categoria_id' => 4, 'descripcion' => 'Reconocimiento de la estrategia organizacional / Preparación a las funciones del cargo/tareas de la práctica / Acompañamiento y Retroalimentación']);
         //DB::table('items')->insert([ 'nombre' => 'Relación con el jefe inmediato ', 'categoria_id' => 4, 'descripcion' => 'Trato interpersonal / Comunicación asertiva / Consideración de desempeño / Valoración de opinión personal / Interés y Atención / Capacidad de liderazgo / Resolución de conflictos']);
         DB::table('items')->insert([ 'nombre' => 'Liderazgo', 'categoria_id' => 4, 'descripcion' => 'Relación con Jefe inmediato / Capacidad de liderar y motivar / Metas retadoras alcanzables / Comunicación asertiva / Disposición de escucha y conciliación / Trato interpersonal/ Retroalimentación']);
         DB::table('items')->insert([ 'nombre' => 'Reconocimiento', 'categoria_id' => 4, 'descripcion' => 'Reconocimiento personal / Reconocimiento laboral / Integración al equipo / Participación']);

         DB::table('items')->insert([ 'nombre' => 'Tareas', 'categoria_id' => 5, 'descripcion' => 'Planificación y Dirección / Satisfacción con el desempeño de las tareas / Claridad de las tareas / Tareas acorde al área de estudio / Promoción de crecimiento laboral']);
         DB::table('items')->insert([ 'nombre' => 'Responsabilidad', 'categoria_id' => 5, 'descripcion' => 'Autonomía / Proyectos propios / Objetivos asignados para la práctica']);
         DB::table('items')->insert([ 'nombre' => 'Carga laboral', 'categoria_id' => 5, 'descripcion' => 'Nivel de carga laboral acorde al horario / Exigencia del supervisor']);
         DB::table('items')->insert([ 'nombre' => 'Condiciones del lugar de trabajo', 'categoria_id' => 5, 'descripcion' => 'Seguridad física en el espacio de trabajo / Condiciones de trabajo adecuadas / Calidad de los equipos de trabajo / Zonas de recreación y descanso / Grado de riesgos']);

         DB::table('items')->insert([ 'nombre' => 'Crecimiento laboral', 'categoria_id' => 6, 'descripcion' => 'Desarrollo de habilidades laborales / Profundización de conocimientos del área de estudio / Adquisición de conocimiento específico del sector/ámbito / Fomento de crecimiento personal']);
         DB::table('items')->insert([ 'nombre' => 'Crecimiento personal', 'categoria_id' => 6, 'descripcion' => 'Desarrollo de habilidades personales y sociales / Oportunidad de establecer contactos / Calidad de referencias de parte de la empresa / Fomento de crecimiento personal / Retroalimentación']);
         DB::table('items')->insert([ 'nombre' => 'Apoyo de sostenimiento', 'categoria_id' => 6, 'descripcion' => 'Remuneración satisfactoria / Pago puntual / Beneficios extralegales']);
         DB::table('items')->insert([ 'nombre' => 'Tiempo laboral', 'categoria_id' => 6, 'descripcion' => 'Cumplimiento de horas establecidas por el contrato / Respeto por el espacio y la vida personal']);
         
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
