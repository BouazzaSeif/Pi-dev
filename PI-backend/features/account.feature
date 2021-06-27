@account @email
Feature:
  I can register as a new user
  I can't login until I verify my account

  Scenario: I register as a new user
    When I send a register request with "kevin.grenier@biig.fr" and "abc123"
    Then I should receive a valid response
    And an email containing the subject "Vérification de votre mail" should be send
    When I click on the link containing "register/verify" in the email
    Then I'm redirect to welcome page
    And I can login with my new created and verified account

  Scenario: I register as a new user but can't use it until I verify it
    When I send a register request with "kevin.grenier@biig.fr" and "abc123"
    Then I should receive a valid response
    And an email containing the subject "Vérification de votre mail" should be send
    And I can't register to my account
