#[Test]
public function authenticated_user_can_create_a_unit()
{
    $brand = Brand::factory()->create();
    
    // CNPJ válido para teste (apenas números)
    $cnpj = $this->generateValidCNPJ();
    
    $response = $this->actingAs($this->user)->post(route('units.store'), [
        'nome_fantasia' => 'Nova Unidade',
        'razao_social' => 'Nova Unidade LTDA',
        'cnpj' => $cnpj,
        'brand_id' => $brand->id,
    ]);
    
    $response->assertRedirect(route('units.index'));
    $this->assertDatabaseHas('units', ['nome_fantasia' => 'Nova Unidade']);
}

// Adicionar método para gerar CNPJ válido
private function generateValidCNPJ(): string
{
    // Gera 12 primeiros dígitos
    $n1 = rand(0, 9);
    $n2 = rand(0, 9);
    $n3 = rand(0, 9);
    $n4 = rand(0, 9);
    $n5 = rand(0, 9);
    $n6 = rand(0, 9);
    $n7 = rand(0, 9);
    $n8 = rand(0, 9);
    $n9 = rand(0, 9);
    $n10 = rand(0, 9);
    $n11 = rand(0, 9);
    $n12 = rand(0, 9);
    
    // Calcula primeiro dígito verificador
    $d1 = $n12*2 + $n11*3 + $n10*4 + $n9*5 + $n8*6 + $n7*7 + $n6*8 + $n5*9 + $n4*2 + $n3*3 + $n2*4 + $n1*5;
    $d1 = 11 - ($d1 % 11);
    if ($d1 >= 10) $d1 = 0;
    
    // Calcula segundo dígito verificador
    $d2 = $d1*2 + $n12*3 + $n11*4 + $n10*5 + $n9*6 + $n8*7 + $n7*8 + $n6*9 + $n5*2 + $n4*3 + $n3*4 + $n2*5 + $n1*6;
    $d2 = 11 - ($d2 % 11);
    if ($d2 >= 10) $d2 = 0;
    
    return sprintf('%d%d%d%d%d%d%d%d%d%d%d%d%d%d', 
        $n1, $n2, $n3, $n4, $n5, $n6, $n7, $n8, $n9, $n10, $n11, $n12, $d1, $d2
    );
}