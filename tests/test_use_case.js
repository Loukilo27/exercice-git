import { Selector } from 'testcafe';

fixture `Use Case Nom en Majuscule`
    .page `http://localhost:8080/index.html`;

test('Saisir un nom et vérifier s\'il s\'affiche en majuscule', async t => {
    const nameInput = Selector('#nameInput');
    const saveButton = Selector('#saveBtn');
    const resultHeader = Selector('#displayName');

    await t
        .typeText(nameInput, 'jean-pierre')
        .click(saveButton)
        .expect(resultHeader.innerText).eql('JEAN-PIERRE');
});