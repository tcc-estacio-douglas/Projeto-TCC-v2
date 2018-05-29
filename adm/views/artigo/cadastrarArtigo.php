<div class="well">
    <div class="page-header">
        <h1>Cadastrar Artigo</h1>
    </div>
     <?php
    if (isset($_SESSION['msg'])):
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    endif;
    if (isset($_SESSION['msgcad'])):
        echo $_SESSION['msgcad'];
        unset($_SESSION['msgcad']);
    endif;

    if (isset($this->Dados[0])):
        $catArtigos = $this->Dados[0];
        //var_dump($catArtigos);
    endif;
    if (isset($this->Dados[1])):
        $valorForm = $this->Dados[1];
    //var_dump($valorForm);
    endif;
    ?>
    
    <form name="CadArtigo" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Titulo:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="titulo_artigo" placeholder="Titulo do Artigo" value="<?php
                if (isset($valorForm['titulo_artigo'])): echo $valorForm['titulo_artigo'];
                endif;
                ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Slug:</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" name="slug_artigo" placeholder="Nome do artigo na URL" value="<?php
                if (isset($valorForm['slug_artigo'])): echo $valorForm['slug_artigo'];
                endif;
                ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Descrição:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="editable" name="descricao_artigo" rows="5"> <?php
                if (isset($valorForm['descricao_artigo'])):
                    echo $valorForm['descricao_artigo'];
                endif;
                ?></textarea>
            </div>
        </div> 
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Conteúdo do Artigo:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="editable" name="conteudo_artigo" rows="10"> <?php
                if (isset($valorForm['conteudo_artigo'])):
                    echo $valorForm['conteudo_artigo'];
                endif;
                ?></textarea>
            </div>
        </div> 
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Foto:</label>
            <div class="col-sm-10">
                <input type="file"  name="foto"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">categoria do Artigo:</label>
            <div class="col-sm-10">
                <select class="form-control" name="categorias_artigo_id">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($catArtigos as $catArtigo):
                        extract($catArtigo);
                        if ($valorForm['categorias_artigo_id'] == $id):
                            $selecionado = "selected";
                        else:
                            $selecionado = "";
                        endif;
                        echo "<option value='$id' $selecionado>$nome_cat_artigo</option>";
                    endforeach;
                    ?>
                </select> 
            </div>
        </div>
        
        <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-sm btn-success" value="Cadastrar" name="SendCadArtigo">
            </div>
        </div>
        
    </form>
    
</div>    