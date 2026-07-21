# QCM — La sécurité (authentification et autorisation)

> **Version :** Symfony **8.0** · **Sources :** [symfony.com/doc/8.0/security.html](https://symfony.com/doc/8.0/security.html) (couvre à la fois Introduction, The User, The Firewall et Access Control/Authorization — ce sont des ancres de cette même page, pas des pages séparées) et les pages de sa section [Learn More](https://symfony.com/doc/8.0/security.html#learn-more) · **Généré le :** _à compléter lors de la génération_
>
> **Nombre de questions :** à déterminer. Chaque question proposera **4 réponses (A à D)**, dont **1 à 4 seront correctes**. La formulation indiquera ce qui est attendu :
>
> - *« Quelle est… / Que fait… »* + mention ***(une seule bonne réponse)*** → exactement une réponse correcte ;
> - *« Quelles sont… / Quelles affirmations… »* + mention ***(plusieurs bonnes réponses)*** → deux réponses correctes ou plus (jusqu'à quatre).
>
> Le corrigé commenté sera ajouté en fin de fichier lors de la génération.

> **Remarque :** `security.html` est la plus grosse page traitée jusqu'ici (~2800 lignes de source), à découper en plusieurs groupes de questions par grande sous-section : Introduction, The User, The Firewall, Authenticating Users, Login Programmatically, Logging Out, Fetching the User Object, Access Control (Authorization), Understanding how Users are Refreshed from the Session, Security Events, FAQ. Prévoir aussi un total de questions nettement supérieur à la moyenne, vu le nombre de pages annexes (15) et l'importance du sujet pour la certification.
>
> **Remarque 2 :** parmi les entrées de la page d'accueil de la doc listées pour la section « Security » (Introduction, Users, Authentication/Firewalls, Authorization/Voters, Passwords, CSRF, LDAP), les 4 premières sont des ancres de `security.html` et les 3 dernières (Passwords, CSRF, LDAP) sont en réalité des pages de la section Learn More de cette même page (voir ci-dessous) — d'où un seul fichier QCM pour l'ensemble, comme pour `HttpKernel`/`Kernel` en Architecture.

## Pour aller plus loin

Les pages listées dans la section [Learn More](https://symfony.com/doc/8.0/security.html#learn-more) de la page, groupées comme sur la page source :

**Authentication (Identifying/Logging in the User)**

- [Password Hashing and Verification](https://symfony.com/doc/8.0/security/passwords.html)
- [Authenticating against an LDAP server](https://symfony.com/doc/8.0/security/ldap.html)
- [How to Add "Remember Me" Login Functionality](https://symfony.com/doc/8.0/security/remember_me.html)
- [How to Impersonate a User](https://symfony.com/doc/8.0/security/impersonating_user.html)
- [How to Create and Enable Custom User Checkers](https://symfony.com/doc/8.0/security/user_checkers.html)
- [How to Restrict Firewalls to a Request](https://symfony.com/doc/8.0/security/firewall_restriction.html)
- [How to Implement CSRF Protection](https://symfony.com/doc/8.0/security/csrf.html)
- [Customizing the Form Login Authenticator Responses](https://symfony.com/doc/8.0/security/form_login.html)
- [How to Write a Custom Authenticator](https://symfony.com/doc/8.0/security/custom_authenticator.html)
- [The Entry Point: Helping Users Start Authentication](https://symfony.com/doc/8.0/security/entry_point.html)

**Authorization (Denying Access)**

- [How to Use Voters to Check User Permissions](https://symfony.com/doc/8.0/security/voters.html)
- [How Does the Security access_control Work?](https://symfony.com/doc/8.0/security/access_control.html)
- [Using Expressions in Security Access Controls](https://symfony.com/doc/8.0/security/expressions.html)
- [How to Customize Access Denied Responses](https://symfony.com/doc/8.0/security/access_denied_handler.html)
- [How to Force HTTPS or HTTP for different URLs](https://symfony.com/doc/8.0/security/force_https.html)
