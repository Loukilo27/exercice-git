import { Selector } from 'testcafe';

fixture `Use Case PHP`
    .page `http://localhost:8080/index.php`; 

test('Saisir un nom et vérifier s\'il s\'affiche en majuscule', async t => {
    const nameInput = Selector('#nameInput');
    const saveButton = Selector('#saveBtn');
    const resultHeader = Selector('#displayName').with({ timeout: 5000 });

    await t
        .typeText(nameInput, 'jean-pierre')
        .click(saveButton)
        .expect(resultHeader.exists).ok('La page result.php n’a pas affiché l’élément #displayName')
        .expect(resultHeader.innerText).eql('JEAN-PIERRE');
});