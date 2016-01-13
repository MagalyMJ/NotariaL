<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            //Clientes, Usuarios de prueba
            $this->call(RoleAndPermicions::class);
            $this->call(UsersTableSeeder::class);
            $this->call(CustumersTableSeeder::class);
            //Catalogos , Documentos,Participantes
            $this->call(CatalogDocumentsSeeder::class);
            //Catalogo de gastos que afectan el presupuesto
            $this->call(CatalogExpensesSeed::class);
            $this->call(CatalogParticipantType::class);
            //Envio de datos de servicios
            $this->call(ServiceTestamentSeeder::class);
            $this->call(ServiceCompraVentaSeed::class);
            $this->call(ServiceDonacionesSeed::class);
            $this->call(ServiceActaCosntitutivaSeed::class);
            $this->call(ServiceContratoMutuoSeed::class);
            $this->call(ServiceCancelacionHipotecaSeed::class);
            $this->call(ServicePoderGeneralSeed::class);
            $this->call(ServiceIntestamentariaSeed::class);
            $this->call(ServiceTestamentariaSeed::class);
            $this->call(ServiceMatrimonilesSeed::class);
            $this->call(ServiceFedeHechosSeed::class);
            $this->call(ServiceRevocacionPoderSeed::class);
            $this->call(ServiceAdjudicacionTestamentariaSeed::class);
            $this->call(ServiceAceptacionHerenciaSeed::class);
            $this->call(ServiceCotejoCertificacionSeed::class);
            $this->call(ServiceActaAsambleaSeed::class);
            $this->call(ServiceProtocolizarSubdireccionSeed::class);
            $this->call(ServiceDacionPagoSeed::class);
            $this->call(ServicePermutasSeed::class);
            $this->call(ServiceAdjudicacionJudicialSeed::class);
            $this->call(ServiceRatificacionDocumentoSeed::class);
            //Creacion de casos de prueva
            $this->call(Case_Budget_Service_Seed::class);
           

        Model::reguard();
    }
}
