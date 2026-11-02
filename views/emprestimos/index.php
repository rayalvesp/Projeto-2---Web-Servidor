    <h1 class="page-title">Novo empréstimo</h1>

    <div class="ficha">
      <div class="ficha__cabecalho">
        <div><strong>Ficha de empréstimo</strong></div>
      </div>

      <form method="POST" action="<?= e(url('/emprestimos')) ?>">
        <div class="linha-campos">
          <div class="campo">
            <?php $usuarioAntigo = antigo('usuario_id'); ?>
            <label for="emprestimo-usuario">Usuário <span class="obrigatorio">*</span></label>
            <select id="emprestimo-usuario" name="usuario_id" required>
              <option value="" disabled<?= $usuarioAntigo === '' ? ' selected' : '' ?>>Selecionar</option>
              <?php foreach ($usuarios as $usuario): ?>
                <option value="<?= e($usuario->getId()) ?>"<?= $usuarioAntigo === (string) $usuario->getId() ? ' selected' : '' ?>>
                  <?= e($usuario->getNome()) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="campo">
            <?php $livroAntigo = antigo('livro_id'); ?>
            <label for="emprestimo-livro">Livro <span class="obrigatorio">*</span></label>
            <select id="emprestimo-livro" name="livro_id" required>
              <option value="" disabled<?= $livroAntigo === '' ? ' selected' : '' ?>>Selecionar</option>
              <?php foreach ($livros as $livro): ?>
                <option value="<?= e($livro->getId()) ?>"<?= $livroAntigo === (string) $livro->getId() ? ' selected' : '' ?>>
                  <?= e($livro->getTitulo()) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="linha-campos">
          <div class="campo">
            <label for="emprestimo-data">Data de empréstimo <span class="obrigatorio">*</span></label>
            <input type="date" id="emprestimo-data" name="data_emprestimo" value="<?= e(antigo('data_emprestimo')) ?>" required />
          </div>

          <div class="campo">
            <label for="emprestimo-devolucao">Data prevista de devolução <span class="obrigatorio">*</span></label>
            <input type="date" id="emprestimo-devolucao" name="data_devolucao" value="<?= e(antigo('data_devolucao')) ?>" required />
          </div>
        </div>

        <div class="acoes-ficha">
          <button type="submit" class="botao botao--primario">Registrar empréstimo</button>
          <a href="<?= e(url('/emprestimos')) ?>" class="botao botao--secundario">Limpar</a>
        </div>
      </form>
    </div>

    <div class="tabela-wrapper">
      <table>
        <thead>
          <tr>
            <th scope="col">Usuário</th>
            <th scope="col">Livro</th>
            <th scope="col">Empréstimo</th>
            <th scope="col">Devolução</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
         <tbody>
          <?php if (empty($emprestimos)): ?>
            <tr><td colspan="5">Nenhum empréstimo registrado.</td></tr>
          <?php else: ?>
            <?php foreach ($emprestimos as $emprestimo): ?>
              <tr>
                <td><?= e($emprestimo->getUsuarioNome()) ?></td>
                <td><?= e($emprestimo->getLivroTitulo()) ?></td>
                <td><?= e(dataBr($emprestimo->getDataEmprestimo())) ?></td>
                <td>
                  <?php 
                    // Exibe a data de devolução formatada, ou em branco se ainda não devolvido
                    $dataDev = $emprestimo->getDataDevolucao();
                    echo $dataDev ? e(dataBr($dataDev)) : '-'; 
                  ?>
                </td>
                <td>
                  <!-- AQUI ENTRA O BOTÃO DE DEVOLVER -->
                  <?php if (empty($emprestimo->getDataDevolucao())): ?>
                    <a href="<?= e(url('/emprestimos/devolver?id=' . $emprestimo->getId())) ?>" class="btn btn-sm btn-success">Devolver</a>
                  <?php else: ?>
                    <span class="badge bg-secondary">Devolvido</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
